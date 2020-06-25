<?php
/**
 * Created By Fachruzi Ramadhan
 *
 * @Filename     MemberTrait.php
 * @LastModified 2/13/19 1:58 PM.
 *
 * Copyright (c) 2019. All rights reserved.
 */

namespace App\Traits\Users;

use App\Models\Auth\User;
use App\Models\Auth\UserAddress;
use App\Models\Auth\UserRole;
use App\Models\Auth\Role;
use App\Models\Product;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

trait MemberTrait
{

    use AttachRoleTrait, ActiveInactive;

    /**
     * Store A Member
     *
     * @param $request
     *
     * @return mixed
     */
    public function storeMember($request){

        $userId = isset($request->member['id']) ? $request->member['id'] : null;

        $userDb       = User::firstOrNew(['id' => $userId]);

        $userDb->name = $request->member['name'];
        $userDb->created_by = Sentinel::guest() == true ? 'web' : Sentinel::getUser()->name;

        if (isset($request->member['email'])) {
            $userDb->email = $request->member['email'];
        }



        if ($userDb->phone == null) {
            $userDb->phone = $request->member['phone'];
        }

        if ($userDb->exists == false) {
            $userDb->type     = 'customer';
            //$userDb->password = bcrypt($request->member['phone']);
            $userDb->password = bcrypt("3C18M" . substr($request->member['phone'], 0, 5));
        }

        $userDb->save();

        #New User Applied

        if($userId === null || $userId == 0){
            #Activate or inactivate This Member
            $this->activeInActive($userDb, 'active');

            #Attach To Sales Role
            $this->attach($userDb, 'Member');

            $this->send_email_register($userDb);
        }

        return $userDb;
    }

    public function storeMemberFront($request){

        $userId = isset($request->member['id']) ? $request->member['id'] : null;

        $userDb       = User::firstOrNew(['id' => $userId]);

        $userDb->name = $request->member['name'];
        $userDb->created_by = 'Web';

        if (isset($request->member['email'])) {
            $userDb->email = $request->member['email'];
        }

        if ($userDb->phone == null) {
            $userDb->phone = $request->member['phone'];
        }

        if ($userDb->exists == false) {
            $userDb->type     = 'customer';
            //$userDb->password = bcrypt($request->member['phone']);
            $userDb->password = bcrypt("3C18M" . substr($request->member['phone'], 0, 5));
        }

        $userDb->save();

        #New User Applied

        if($userId === null || $userId == 0){
            #Activate or inactivate This Member
            $this->activeInActive($userDb, 'active');

            #Attach To Sales Role
            $this->attach($userDb, 'Member');

            $this->send_email_register($userDb);
        }

        #Attach To Group
        $this->attachToGroup($userDb, $request->group);

        return $userDb;
    }

    public function storeMemberWa($request){

      $userId = isset($request->id) ? $request->id : null;

      $userDb       = User::firstOrNew(['id' => $userId]);

      $userDb->name = $request->nama;
      $userDb->created_by = 'Web - Whatsapp';

      if (isset($request->email)) {
          $userDb->email = $request->email;
      }

      if ($userDb->phone == null) {
          $userDb->phone = $request->noHp;
      }

      if ($userDb->exists == false) {
          $userDb->type     = 'customer';
          //$userDb->password = bcrypt($request->member['phone']);
          $userDb->password = bcrypt("3C18M" . substr($request->noHp, 0, 5));
      }

      $userDb->save();

      #New User Applied

      if($userId === null || $userId == 0){
          #Activate or inactivate This Member
          $this->activeInActive($userDb, 'active');

          #Attach To Sales Role
          $this->attach($userDb, 'Member');

          #Attach To Group
          $this->attachToGroup($userDb, $request->group);

          $this->send_email_register($userDb);
      }

      return $userDb;
  }

    public function storeMemberBySales($request){
        //dd($request->member);
        $userId = isset($request->member['id']) ? $request->member['id'] : null;

        $userDb       = User::firstOrNew(['id' => $userId]);

        $userDb->name = $request->member['name'];
        $userDb->created_by = Sentinel::getUser()->email;
        $userDb->updated_by = Sentinel::getUser()->email;

        if (isset($request->member['email'])) {
            $userDb->email = $request->member['email'];
        }

        if ($userDb->phone == null) {
            $userDb->phone = $request->member['phone'];
        }

        if ($userDb->exists == false) {
            $userDb->type     = 'customer';
            //$userDb->password = bcrypt($request->member['phone']);
            $userDb->password = bcrypt("3C18M" . substr($request->member['phone'], 0, 5));
        }

        $userDb->save();

        #New User Applied

        if($userId === null || $userId == 0){
            #Activate or inactivate This Member
            $this->activeInActive($userDb, 'active');

            #Attach To Sales Role
            $this->attach($userDb, 'Member');
        }

        return $userDb;
    }

    /**
     * Store Member Address
     *
     * @param $userId
     * @param $member
     *
     * @return
     */
    public function storeMemberAddress($userId, $member)
    {
        $addressDb          = UserAddress::firstOrNew(['user_id' => $userId]);

        $addressDb->address = isset($member['address']['address']) ? $member['address']['address'] : null;

        if (isset($member['address']['subdistrict_id']) && $member['address']['subdistrict_id'] !== null) {
            $addressDb->subdistrict_id = $member['address']['subdistrict_id'];
            $addressDb->province       = $member['address']['province'];
            $addressDb->postal_code    = $member['address']['postal_code'];
        }

        $addressDb->save();

        return $addressDb;
    }

    public function send_email_register($user)
    {
        try {
            $content = '<!DOCTYPE html>
                            <html>
                              <head>
                                <title></title>
                              </head>
                              <body>
                                <div style="max-width:600px;background:rgb(255,255,255) none repeat scroll 0% 0%;margin:0px auto">
                                  <table style="font-size:0px;width:100%;background:rgb(255,255,255) none repeat scroll 0% 0%" align="center" cellspacing="0" cellpadding="0" border="0">
                                    <tbody>
                                      <tr>
                                        <td style="text-align:center;vertical-align:top;font-size:0px">
                                          <div class="m_-2031116837044027653m_-181961659305639231column m_-2031116837044027653m_-181961659305639231column-100" style="display:inline-block;width:100%;vertical-align:top">
                                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                              <tbody>
                                                <tr>
                                                  <td class="m_4178287543717492059m_8500764122952422996alignmentContainer" style="word-break:break-word;font-size:0px;padding:0px;text-align:center">
                                                    <img src="https://ellen-may.com/images/logo-ellen-may.png" alt="image" width="258" style="font-family:Helvetica,Arial,sans-serif;font-size:20px;width:43%">
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </div>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <div style="max-width:600px;background:rgb(255,255,255) none repeat scroll 0% 0%;margin:0px auto">
                                  <table style="font-size:0px;width:100%;background:rgb(255,255,255) none repeat scroll 0% 0%" align="center" cellspacing="0" cellpadding="0" border="0">
                                    <tbody>
                                      <tr>
                                        <td style="text-align:center;vertical-align:top;font-size:0px">
                                          <div class="m_-2031116837044027653m_-181961659305639231column m_-2031116837044027653m_-181961659305639231column-100" style="display:inline-block;width:100%;vertical-align:top">
                                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                              <tbody>
                                                <tr>
                                                  <td style="font-size:0px;padding:15px;text-align:left">
                                                    <div>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">Hai '.$user->name.', selamat datang di Ellen-may.com. Salam kenal! :)<br></p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Pasar modal adalah dunia yang sangat dinamis, untuk itu Anda harus belajar terlebih dahulu sebelum melakukan investasi. Pada platform <a href="https://ellen-may.com">https://ellen-may.com</a> anda dapat belajar banyak hal mengenai financial market melalui fitur – fitur yang ada, seperti:</p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Berikut Akses anda untuk menikmati fitur – fitur yang ada di <a href="https://ellen-may.com">https://ellen-may.com</a>:</p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;padding-left:20px;margin:13px 0px;line-height:1.6"><b>•</b> Kopi Pagi & Top 5 Stock’s <b>(Berisi ulasan market dan sentimen yang akan dihadapi)</b></p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;padding-left:20px;margin:13px 0px;line-height:1.6"><b>•</b> Educational Articles</p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;padding-left:20px;margin:13px 0px;line-height:1.6"><b>•</b> E-books</p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;padding-left:20px;margin:13px 0px;line-height:1.6"><b>•</b> Video</p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Berikut Akses anda untuk menikmati fitur – fitur yang ada di www.ellen-may.com:</p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6"><b>User ID :</b> <b style="color:red;">'.$user->email.'</b></p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6"><b>Password :</b> <b style="color:red;">'. "D9RajJi6" . substr($user->phone, 0, 5).'</b></p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Lalu kami juga akan mengirimkan perkembangan informasi terkait dunia saham secara langsung ke inbox email Anda.</p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;padding-top:20px;margin:13px 0px;line-height:1.6">Untuk mendapatkan manfaat serta layanan yang maksimal, pastikan Anda membaca petunjuk di bawah ini secara lengkap dan mengikuti langkah-langkahnya dengan baik:</p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6"><b>Step 1. Whitelist & Prioritaskan Semua Email dari Ellen May</b></p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Hal ini sangat penting supaya Anda mendapatkan update, informasi terbaru, tips dan trik investasi, produk dan events. Percayalah, <b>ANDA TIDAK MAU</b> melewatkan satu pun dari update tersebut.</p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Jadi lakukan hal-hal ini untuk memastikan tidak ada yang terlewat oleh Anda:</p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;padding-left:20px;margin:13px 0px;line-height:1.6">1. Semua email akan dikirimkan melalui alamat noreply@ellen-may.com. Pastikan Anda menandai email tersebut dengan bintang (*) atau Mark as Important, sehingga email dari saya pasti masuk ke Inbox Anda.</p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;padding-left:20px;margin:13px 0px;line-height:1.6">2. <b>Kalau Anda menggunakan Gmail, pastikan untuk "drag" email dari Ellen May Institute ke dalam Priority Inbox Anda</b> (Ingat bahwa Anda tidak ingin melewatkan sesuatu dari saya).</p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;padding-left:20px;margin:13px 0px;line-height:1.6"><b>Gmail</b></p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;padding-left:40px;margin:13px 0px;line-height:1.6">- Jika email dari Ellen May Institute masuk ke dalam promotion</p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;padding-left:40px;margin:13px 0px;line-height:1.6">- Kemudian seret kolom promotion ke kolom primary atau utama</p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;padding-left:40px;margin:13px 0px;line-height:1.6">- Untuk selanjutnya, email dari saya akan langsung masuk di kolom email utama (primary) Anda</p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6"><b>Step 2. Social Media</b></p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Anda juga dapat berkomunikasi dengan saya melalui social media berikut ini:</p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Telegram : <a href="t.me/ellenmayinstitute">t.me/ellenmayinstitute</a></p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Facebook : <a href="https://www.facebook.com/EllenMay.Pakarsaham">https://www.facebook.com/EllenMay.Pakarsaham</a></p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Twitter : <a href="http://www.twitter.com/pakarsaham">http://www.twitter.com/pakarsaham</a></p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Instagram : <a href="http://www.instagram.com/ellenmay_official">http://www.instagram.com/ellenmay_official</a></p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Snapchat : @Pakarsaham</p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;padding-top:20px;margin:13px 0px;line-height:1.6">Keberhasilan investasi dan trading memerlukan pembelajaran yang <b>konsisten dan fokus!</b> Saat Anda memperhatikan semua hal-hal kecil yang terkait dengan pasar modal, Anda bisa mendapat manfaat yang mungkin tidak pernah Anda sangka-sangka. Selamat belajar dan mengambil manfaatnya.</p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;padding-top:50px;margin:13px 0px;line-height:1.6">Salam profit,</p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;padding-top:20px;margin:13px 0px;line-height:1.6">@PakarSaham</p>
                                                      <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:10px;padding:0px;margin:13px 0px;line-height:1.6">CEO Ellen May Institute </p>
                                                    </div>
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </div>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <div style="max-width:600px;background:rgb(255,255,255) none repeat scroll 0% 0%;margin:0px auto">
                                  <table style="font-size:0px;width:100%;background:rgb(255,255,255) none repeat scroll 0% 0%" align="center" cellspacing="0" cellpadding="0" border="0">
                                    <tbody>
                                      <tr>
                                        <td style="text-align:center;vertical-align:top;font-size:0px">
                                          <div class="m_-2031116837044027653m_-181961659305639231column m_-2031116837044027653m_-181961659305639231column-100" style="display:inline-block;width:100%;vertical-align:top">
                                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                              <tbody>
                                                <tr>
                                                  <td style="font-size:0px;padding:15px;text-align:center" class="m_-2031116837044027653m_-181961659305639231alignmentContainer">
                                                    <div style="margin-left:auto;margin-right:auto">
                                                      <p style="font-family:Helvetica,Arial,sans-serif;padding:0px;margin:13px 0px 0px;line-height:1.6;color:rgb(153,153,153);font-size:11px">Ellen May Institute Ruko Sentra Niaga Puri Indah Blok T1 No 12A, Puri Kembangan Jakarta Barat, Jakarta Raya Indonesia +6282327229009</p>
                                                    </div>
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </div>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                 </div>
                              </body>
                            </html>';

            $recipient_email[] = [
                'recipient' => $user->email
            ];

            $field = [
                'subject' => 'Hallo '.$user->name.', Selamat datang di Ellen May Institute',
                'content' => $content,
                'from'    => array(
                    'fromEmail' => 'noreply@ellen-may.com',
                    'fromName'  => 'Ellen May Institute'
                ),
                'personalizations' => $recipient_email
            ];

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL             => 'https://api.pepipost.com/v2/sendEmail',
                CURLOPT_RETURNTRANSFER  => true,
                CURLOPT_ENCODING        => '',
                CURLOPT_MAXREDIRS       => 10,
                CURLOPT_TIMEOUT         => 30,
                CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST   => 'POST',
                CURLOPT_POSTFIELDS      => json_encode($field),
                CURLOPT_HTTPHEADER      => array(
                    'api_key: '.config("pepipost.api_key_pepipost")
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if($err){
                echo $err;
            }
            else{

            }
        }
        catch (Exception $e) {

        }
    }
}
