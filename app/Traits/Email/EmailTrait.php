<?php
/**
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename EmailTrait.php
 * @LastModified 15/10/2019, 12:43
 */

namespace App\Traits\Email;

trait EmailTrait
{
    public function send_email($field)
    {
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

    public function send_email_paid_1($order)
    {
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
                                                <p class="m_-2031116837044027653m_-181961659305639231bard-text-block m_-2031116837044027653m_-181961659305639231style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:0px 0px 13px;line-height:1.6"><br></p>
                                                <p class="m_-2031116837044027653m_-181961659305639231bard-text-block m_-2031116837044027653m_-181961659305639231style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">Hai '.$order->customer->name.', <br></p>
                                                <p class="m_-2031116837044027653m_-181961659305639231bard-text-block m_-2031116837044027653m_-181961659305639231style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">Senang sekali saya menyambut Anda menjadi calon member eksklusif <b>Super Trader Signal ID</b><br></p>
                                                <p class="m_-2031116837044027653m_-181961659305639231bard-text-block m_-2031116837044027653m_-181961659305639231style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">dan terima kasih Anda telah mengambil langkah yang luar biasa dengan melakukan pembayaran untuk membership Super Trader Signal ID. <br></p>
                                                <p class="m_-2031116837044027653m_-181961659305639231bard-text-block m_-2031116837044027653m_-181961659305639231style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;padding-left:17%;padding-right:17%;margin:13px 0px;line-height:1.6"><b><i>“The journey of a thousand miles begins with one step”</i></b><br></p>
                                                <p class="m_-2031116837044027653m_-181961659305639231bard-text-block m_-2031116837044027653m_-181961659305639231style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">Setelah ini kami akan kirimkan 2 email berikutnya yang berisi 5 Golden Rules dan Akses untuk menuju Super Trader Signal ID. Ditunggu ya</p>
                                                <p class="m_-2031116837044027653m_-181961659305639231bard-text-block m_-2031116837044027653m_-181961659305639231style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6"> <br></p>
                                                <p class="m_-2031116837044027653m_-181961659305639231bard-text-block m_-2031116837044027653m_-181961659305639231style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">Salam profit,</p>
                                                <p class="m_-2031116837044027653m_-181961659305639231bard-text-block m_-2031116837044027653m_-181961659305639231style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">Client Relation Officer</p>
                                                <p class="m_-2031116837044027653m_-181961659305639231bard-text-block m_-2031116837044027653m_-181961659305639231style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">Ellen May Institute</p>
                                                <p class="m_-2031116837044027653m_-181961659305639231bard-text-block m_-2031116837044027653m_-181961659305639231style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px 0px;line-height:1.6"><br></p>
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
            'recipient' => $order->customer->email
        ];

        $field = [
            'subject' => 'Terima kasih '.$order->customer->name.', Pembayaran Anda Akan Kami Periksa',
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

    public function send_email_paid_2($order)
    {
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
                                            <td class="m_-10981391161780189m_3013811578915501320alignmentContainer" style="word-wrap:break-word;word-break:break-word;font-size:0px;padding:0px;text-align:center">
                                              <img src="https://ellen-may.com/images/super-trader-signal-id.png" alt="Company Logo" width="396" style="font-family:Helvetica,Arial,sans-serif;font-size:20px;width:66%;margin-left:auto;margin-right:auto">
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
                                                <p class="m_-10981391161780189m_3013811578915501320bard-tex=t-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:0px 0px 13px;line-height:1.6">Halo Pak/Bu '.$order->customer->name.',</p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">Saya Ellen May.</p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">Pertama, saya ucapkan selamat buat Anda, karena sudah mengambil langkah yang luar biasa untuk menjadi member eksklusif Super Trader Signal ID</p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">Ada 5 hal penting yang saya ingin bagikan supaya Anda bisa segera bisa jadi Super Trader, yaitu 5 Golden Rules Super Trader.</p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">5 Golden rules Super Trader ™:</p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">• Start small. Gunakan uang dingin, nominalnya kecil saja yang benar-benar membuat Anda merasa leluasa</p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">• Gunakan nominal yang sama setiap kali membeli saham, jangan berubah-ubah (berubah2 artinya : beli banyak jika yakin, beli sedikit jika ragu)</p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">• Fokus pada Super Trader ™ saja. Pisahkan portfolio Super Trader ™ dari Swing Trader. Swing Trader profit lebih kecil dan lebih beresiko karena fluktuasi lebih tinggi. Super Trader ™ profit lebih banyak dan lebih santai tradingnya.</p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">• Jangan beli lebih dari 5 saham jika Anda baru memulai. Boleh beli saham ke 6 jika ke 5 saham Anda semua sudah dalam posisi untung minimal 10%</p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">• Sabar. Kalau Anda kena beberapa kali proteksi / stop loss pada Super Trader ™, itu wajar. Sabar, beri waktu 3-6 bulan dengan konsisten supaya Anda bisa merasakan kekuatan dari konsistensi yaitu NET PROFIT di atas kinerja pasar.</p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">Ok... sekarang mungkin Anda ingin tahu... “Apa saja yang akan saya terima sebagai member Super Trader Signal ID?”</p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">Setiap hari Anda akan menerima rekomendasi saham Hot List, Portfolio Update, Super Stock Snap, dan Stocks Diary melalui Telegram, Email, dan web. Setiap pagi, ada Morning Briefing jam 8:15 yang bisa Anda akses melalui HP di manapun Anda berada, dan Anda bebas tanya jawab melalui Morning Briefing dan dari fitur Tanya Saham di web.</p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">Setiap pekan, Anda akan menerima report weekly yaitu Weekly Insight, dan setiap awal bulan, Anda akan menerima report monthly yaitu Monthly Exclusive Insight.</p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">Untuk mempercepat proses menjadi seorang Super Trader ™, dan supaya Anda bisa menikmati semua layanan yang kami berikan, maka ada 3 langkah yang wajib Anda lakukan sebagai member baru Super Trader Signal ID</p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">Langkah 1: Tonton video <a href="https://ci323.infusionsoft.com/app/linkClick/31413/f304f561d15206be/42179770/3c4ddea6386f6a9d" class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(6,69,173);padding:0px;line-height:1.6" target="_blank">5 “Golden Rules”</a> di download file xxx berikut ini dan baca sampai habis </p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">Langkah 2: baca ebook <a href="https://ci323.infusionsoft.com/app/linkClick/31377/819e8d06610cc82c/42179770/3c4ddea6386f6a9d" class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(6,69,173);padding:0px;line-height:1.6" target="_blank">“Cara Mudah jadi Super Trader ™”</a>, dan tonton video “5 Golden Rules” yang saya kirim berikut ini yah ... saya akan menyapa Anda secara langsung (penting).</p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">Langkah 3: Tonton video panduan member di <a href="https://youtu.be/pAJeFl-7VEo">https://youtu.be/pAJeFl-7VEo</a></p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">Login akun Anda di <a href="https://ellen-may.com">https://ellen-may.com</a> pada browser (Google Chrome, Mozilla Firefox) dan jangan lupa aktikan notifikasi pada laptop serta hp Anda, supaya Anda bisa mendapat manfaat maksimal dari semua informasi yang kami berikan.</p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">Kalau ada kendala, jangan sungkan untuk hubungi Client Relations kami segera ya.</p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6"><b class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="padding:0px;line-height:1.6"><br></b></p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6"><b class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="padding:0px;line-height:1.6">We make money, </b><b class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="padding:0px;line-height:1.6">We change lives better! </b></p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6"><b class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="padding:0px;line-height:1.6">Salam profit, Ellen May </b></p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6"><b class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="padding:0px;line-height:1.6">For PremiumAccess.id</b></p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6"><br></p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px;line-height:1.6">PS : jika Anda butuh bantuan lebih lanjut silakan hubungi Client Relations Officer kami di <a href="http://premiumaccess.id/whatsaapp">http://premiumaccess.id/whatsaapp</a></p>
                                                <p class="m_-10981391161780189m_3013811578915501320bard-text-block m_-10981391161780189m_3013811578915501320style-scope" style="color:rgb(0,0,0);font-family:Helvetica,Arial,sans-serif;font-size:13px;padding:0px;margin:13px 0px 0px;line-height:1.6"><br></p>
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
                                      <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                        <tbody>
                                          <tr>
                                            <td class="m_-10981391161780189m_3013811578915501320alignmentContainer" style="word-wrap:break-word;word-break:break-word;font-size:0px;padding:15px;text-align:center"><img src="https://d1yoaun8syyxxt.cloudfront.net/ci323-fed1fdcd-a771-41ae-bab3-07e073efa2f9-v2" width="570" style="width:100%">
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
            'recipient' => $order->customer->email
        ];

        $field = [
            'subject' => $order->customer->name.', tolong baca email ini (penting) [Super Trader Signal ID]',
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

    public function send_email_paid_3($user)
    {
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
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">Hai '.$user->name.', <br></p>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Seperti yang sudah kami janjikan sebelumnya. Setelah Anda download Ebook Strategi Trading dan Investasi Saham Untuk Pemula dan tonton video panduan penggunaan platform, maka kali ini Anda akan menerima akses untuk masuk ke layanan <b>Super Trader Signal ID</b>.</p>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Sebagai member <b>Super Trader Signal ID</b>, Anda akan bisa pelajari berbagai layanan yang kami akan deliver ke Anda yaitu:</p>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px 0px;line-height:1.6"><br></p>
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
                                      <table border="2" cellspacing="0" cellpadding="0" width="100%">
                                        <tbody>
                                          <tr>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">Nama Layanan </p>
                                              </div>
                                            </td>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">Kapan Anda menerima </p>
                                              </div>
                                            </td>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">Di mana Anda bisa dapatkan </p>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">Daily Hot List </p>
                                              </div>
                                            </td>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">Setiap hari sebelum jam 8 pagi </p>
                                              </div>
                                            </td>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6"><a href="https://ellen-may.com/">Platform Ellen-May.com dan Email </a></p>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">Real Time Recommendation </p>
                                              </div>
                                            </td>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">Sepanjang jam bursa </p>
                                              </div>
                                            </td>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6"><code href="https://ellen-may.com/super-trader-signal-id/recommendation/real-time-recommendation">https://ellen-may.com/super-trader-signal-id/recommendation/real-time-recommendation</a></p>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">Stock Snap </p>
                                              </div>
                                            </td>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">1x sehari </p>
                                              </div>
                                            </td>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6"><a href="https://ellen-may.com/super-trader-signal-id/fundamental/daily-stock-snap">https://ellen-may.com/super-trader-signal-id/fundamental/daily-stock-snap</a></p>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">Exclusive Monthly Insight [Gold]</p>
                                              </div>
                                            </td>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">Setiap hari Senin pertama awal bulan</p>
                                              </div>
                                            </td>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6"><a href="https://ellen-may.com/super-trader-signal-id/fundamental/daily-insights">https://ellen-may.com/super-trader-signal-id/fundamental/daily-insights</a></p>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">Exclusive Gathering [Gold]</p>
                                              </div>
                                            </td>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">1 x setiap bulan</p>
                                              </div>
                                            </td>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">TBA</p>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">Exclusive Webinar by Coaches [Gold]</p>
                                              </div>
                                            </td>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">1 x setiap bulan</p>
                                              </div>
                                            </td>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">TBA (Jadwal akan diemail)</p>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">Morning Briefing [Gold]</p>
                                              </div>
                                            </td>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">Setiap hari jam 8.15</p>
                                              </div>
                                            </td>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6"><a href="https://ellen-may.com/">Platform Ellen-May.com dan Email</a></p>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">Recent Position Super Trader Signal. ID [Gold]</p>
                                              </div>
                                            </td>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">Setiap hari</p>
                                              </div>
                                            </td>
                                            <td style="font-size:12px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6"><a href="https://ellen-may.com/super-trader-signal-id/recommendation/recent-positions">https://ellen-may.com/super-trader-signal-id/recommendation/recent-positions</a></p>
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
                                            <td style="font-size:0px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">Anda akan menerima layanan dari beberapa jalur, antara lain <br></p>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6"><b class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="padding:0px;line-height:1.6">1. PLATFORM <a href="https://ellen-may.com">https://ellen-may.com</a></b><br></p>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Cara akses ke platform : <br></p>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6"><b class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="padding:0px;line-height:1.6">• Meluncur ke <a href="https://ellen-may.com">https://ellen-may.com</a> , <br></b></p>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6"><b class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="padding:0px;line-height:1.6">• Masukkan Email Anda : '.$user->email.'<br></b></p>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6"><b class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="padding:0px;line-height:1.6">• Password : Isi Password Anda (Jika belum diganti, Password Default anda adalah nomor hp yang terdaftar)</b><br></p>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6"><b class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="padding:0px;line-height:1.6">•</b> Selanjutnya pilih menu <b>Super Trader Signal ID</b></p>
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
                                      <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                        <tbody>
                                          <tr>
                                            <td style="font-size:0px;padding:15px;text-align:left">
                                              <div>
                                                <img src="'.asset('images/ellen-may-com-menu.png').'" alt="image" width="600" style="font-family:Helvetica,Arial,sans-serif;font-size:20px;width:100%;margin-left:auto;margin-right:auto">
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
                                      <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                        <tbody>
                                          <tr>
                                            <td style="font-size:0px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px 0px;line-height:1.6"><b class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="padding:0px;line-height:1.6">•</b> Melalui platform ini, Anda akan bisa dapatkan berbagai informasi layanan-layanan yang ada di <b>Super Trader Signal ID</b>. </p>
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
                                      <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                        <tbody>
                                          <tr>
                                            <td style="font-size:0px;padding:15px;text-align:left">
                                              <div>
                                                <img src="'.asset('images/ellen-may-com.png').'" alt="image" width="600" style="font-family:Helvetica,Arial,sans-serif;font-size:20px;width:100%;margin-left:auto;margin-right:auto">
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
                                      <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                        <tbody>
                                          <tr>
                                            <td style="word-break:break-word;font-size:0px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6"><b class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="padding:0px;line-height:1.6">2. VIDEO ONLINE URL</b> <br></p>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Video Online untuk Exclusive Morning Briefing akan diberikan setiap hari melalui Email dan platform. Demikian pula dengan url Video Online Webinar. <br></p>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Melalui Video Online ini, Anda akan bisa tanya jawab langsung dalam Exclusive Morning Briefing dan Webinar baik Bersama Ms Ellen May ataupun team Coaches. <br></p>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6"><br></p>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6"><b class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="padding:0px;line-height:1.6">3. EMAIL </b><br></p>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Pastikan cek email Anda setiap pagi supaya Anda bisa nikmati Daily Hot List melalui Email juga, selain dari platform. <br></p>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6"><br></p>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Kami akan terus memberikan yang terbaik, dan lebih baik lagi buat Anda Selamat menikmati bimbingan intensif melalui Super Trader Signal ID, dan belajar lebih dalam pada pelatihan Super Performance Trader. </p>
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
                                      <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                        <tbody>
                                          <tr>
                                            <td style="word-break:break-word;font-size:0px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px;line-height:1.6">Salam Profit<br></p>
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
                                      <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                        <tbody>
                                          <tr>
                                            <td style="word-break:break-word;font-size:0px;padding:15px;text-align:left">
                                              <div>
                                                <img src="https://d1yoaun8syyxxt.cloudfront.net/ci323-6b2f0c98-2197-46ab-8ab7-70e4af05102b-v2" alt="image" width="108" style="font-family:Helvetica,Arial,sans-serif;font-size:20px;width:18%">
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
                                      <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                        <tbody>
                                          <tr>
                                            <td style="word-break:break-word;font-size:0px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px;line-height:1.6">CEO Ellen May Institute<br></p>
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
                                      <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                        <tbody>
                                          <tr>
                                            <td style="word-break:break-word;font-size:0px;padding:15px;text-align:left">
                                              <div>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">Be a super performance trader ! Your success is my happiness <br></p>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6"><br></p>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Support : Untuk problem teknis IT seperti layanan password / reset password, teknis telegram bot dll. Hubungi support@ellen-may.com<br></p>
                                                <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px 0px;line-height:1.6">Untuk info lainnya hubungi info@ellen-may.com &amp; 082327229009 (phone call for faster response</p>
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
            'subject' => $user->name.', Akses untuk menuju Super Trader Signal ID',
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

    public function send_hot_lists($post, $user)
    {
        foreach ($user as $user) {
            $content = '<!DOCTYPE html>
                          <html>
                            <head>
                            </head>
                            <body>
                              <div id="mainContent" style="text-align: start;">
                                <table cellpadding="10" cellspacing="0" style="background-color: rgb(255,255,255); width: 100%; height: 100%;">
                                  <tbody>
                                    <tr>
                                      <td valign="top">
                                        <table align="center" cellpadding="0" cellspacing="0">
                                          <tbody>
                                            <tr>
                                              <td>
                                                <table bgcolor="#FFFFFF" cellpadding="20" cellspacing="0" style="width: 600px; background-color: rgb(255,255,255);">
                                                  <tbody>
                                                    <tr>
                                                      <td sectionid="body" style="text-align: start; margin: 0; padding: 20px; border: none; white-space: normal; line-height: normal; background-color: rgb(255,255,255);" valign="top">
                                                        <div>
                                                          <div contentid="logo">
                                                            <div contentid="logo">
                                                              <div style="text-align: center;">
                                                                <img align="bottom" alt="Company Logo" border="0" height="200" src="https://ellen-may.com/images/super-trader-signal-id.png" style="margin: 0; margin-right: 0px; margin-left: 0px; padding: 0; background: none; border: none; white-space: normal; line-height: normal;" title="Company Logo" width="370" />
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div>
                                                          <div style="height: 20px;">
                                                            <div style="height: 10px; border-bottom: 1px solid rgb(204,204,204);">
                                                              &nbsp;
                                                            </div>
                                                            <div style="height: 10px;">
                                                              &nbsp;
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div>
                                                          <div style="margin: 0; padding: 0; background: none; border: none; white-space: normal; line-height: normal; overflow: visible; color: rgb(0,0,0); font-size: 12px; font-family: arial;">
                                                            <div contentid="paragraph" style="margin: 0; padding: 0; background: none; border: none; white-space: normal; line-height: normal; overflow: visible; color: rgb(0,0,0); font-size: 12px; font-family: arial;">
                                                              <div style="overflow: visible;">
                                                                <div style="overflow: visible;">
                                                                  <span data-mce-mark="1" style="font-family: helvetica; font-size: 12pt;"><span style="font-family: helvetica; font-size: 13pt;">Good morning </span>'.$user->name.'</span>
                                                                </div>
                                                                <div style="overflow: visible;">
                                                                  <span data-mce-mark="1" style="font-family: helvetica; font-size: 13pt;">&nbsp;</span>
                                                                </div>
                                                                <div style="overflow: visible;">
                                                                  <span style="font-family: helvetica; font-size: 13pt;">'.$post->content.'</span>
                                                                </div>
                                                                <div style="overflow: visible;">
                                                                  <span style="font-family: helvetica; font-size: 13pt;">Please do not reply this email, contact support@ellen-may.com for technical support and info@ellen-may.com for other information.</span>
                                                                </div>
                                                                <div style="overflow: visible;">
                                                                  <span data-mce-mark="1" style="font-family: helvetica; font-size: 13pt;">&nbsp;</span>
                                                                </div>
                                                                <div style="overflow: visible;">
                                                                  <span style="font-family: helvetica; font-size: 13pt;">Faster response : call 0823 - 2722 - 9009</span>
                                                                </div>
                                                                <div style="overflow: visible;">
                                                                  <span data-mce-mark="1" style="font-family: helvetica; font-size: 13pt;">&nbsp;</span>
                                                                </div>
                                                                <div style="overflow: visible;">
                                                                  <span style="font-family: helvetica; font-size: 13pt;"><b>Disclaimer :</b></span>
                                                                </div>
                                                                <div style="overflow: visible;">
                                                                  <span data-mce-mark="1" style="font-family: helvetica; font-size: 13pt;">&nbsp;</span>
                                                                </div>
                                                                <div style="overflow: visible;">
                                                                  <span style="font-family: helvetica; font-size: 13pt;">Setiap rekomendasi saham dalam The Ellen May Premium Access ini bersifat sebagai referensi / bahan pertimbangan, dan bukan merupakan perintah beli / jual. Setiap keuntungan dan kerugian menjadi tanggung jawab dari pelaku pasar.</span>
                                                                </div>
                                                                <div style="overflow: visible;">
                                                                  <span data-mce-mark="1" style="font-family: helvetica; font-size: 13pt;">&nbsp;</span>
                                                                </div>
                                                                <div style="overflow: visible;">
                                                                  <span style="font-family: helvetica; font-size: 13pt;">Call to action yang dikirim melalui Telegram Channel bersifat sebagai pengingat dan bisa saja terjadi delay dalam pengiriman karena faktor jaringan / koneksi, baik dari kami maupun jaringan Anda. Jadi, jagai setiap level key action strategy Anda dengan mandiri</span>
                                                                </div>
                                                                <div style="overflow: visible;">
                                                                  <span data-mce-mark="1" style="font-family: helvetica; font-size: 12pt;">&nbsp;</span>
                                                                </div>
                                                                <div style="overflow: visible;">
                                                                  <span style="font-family: helvetica; font-size: 13pt;"><b>Copyright : Ellen May Institute</b></span>
                                                                </div>
                                                                <div style="overflow: visible;">
                                                                  <span data-mce-mark="1" style="font-family: helvetica; font-size: 13pt;">&nbsp;</span>
                                                                </div>
                                                                <div style="overflow: visible;">
                                                                  <span style="font-family: helvetica; font-size: 13pt;">Dilarang mengutip, dan meneruskan sebagian atau seluruh isi dari materi ini, tanpa seijin pihak Ellen May Institute. Hak cipta dilindungi undang-undang</span>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </td>
                                                    </tr>
                                                    <tr>
                                                      <td sectionid="footer" style="text-align: start; margin: 0; padding: 20px; border: none; white-space: normal; line-height: normal; background-color: rgb(255,255,255);" valign="top">
                                                        <p style="font-family:Helvetica,Arial,sans-serif;padding:0px;margin:13px 0px 0px;line-height:1.6;color:rgb(153,153,153);font-size:11px">Ellen May Institute Ruko Sentra Niaga Puri Indah Blok T1 No 12A, Puri Kembangan Jakarta Barat, Jakarta Raya Indonesia +6282327229009</p>
                                                      </td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </body>
                          </html>';

            $recipient_email[] = [
                'recipient' => $user->user->email
            ];

            $field = [
                'subject' => $post->name,
                'content' => $content,
                'from'    => array(
                    'fromEmail' => 'noreply@ellen-may.com',
                    'fromName'  => 'Super Trader Signal (Premium Access)'
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
    }

    public function send_kopipagi($post, $user)
    {
        foreach ($user as $user) {
            $content = '<html>
                          <head>
                          </head>
                          <body>
                            <div id="mainContent" style="text-align: start;">
                              <table cellpadding="10" cellspacing="0" style="background-color: rgb(255,255,255); width: 100%; height: 100%;">
                                <tbody>
                                  <tr>
                                    <td valign="top">
                                      <table align="center" cellpadding="0" cellspacing="0">
                                        <tbody>
                                          <tr>
                                            <td>
                                              <table bgcolor="#FFFFFF" cellpadding="20" cellspacing="0" style="width: 600px; background-color: rgb(255,255,255);">
                                                <tbody>
                                                  <tr>
                                                    <td sectionid="body" style="text-align: start; margin: 0; padding: 20px; border: none; white-space: normal; line-height: normal; background-color: rgb(255,255,255);" valign="top">
                                                      <div>
                                                        <div contentid="logo">
                                                          <div contentid="logo">
                                                            <div style="text-align: center;">
                                                              <img align="bottom" alt="Company Logo" border="0" height="200" src="https://ellen-may.com/images/logo-ellen-may.png" style="margin: 0; margin-right: 0px; margin-left: 0px; padding: 0; background: none; border: none; white-space: normal; line-height: normal;" title="Company Logo" width="370" />
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div>
                                                        <div style="height: 20px;">
                                                          <div style="height: 10px; border-bottom: 1px solid rgb(204,204,204);">
                                                            &nbsp;
                                                          </div>
                                                          <div style="height: 10px;">
                                                            &nbsp;
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div>
                                                        <div style="margin: 0; padding: 0; background: none; border: none; white-space: normal; line-height: normal; overflow: visible; color: rgb(0,0,0); font-size: 12px; font-family: arial;">
                                                          <div contentid="paragraph" style="margin: 0; padding: 0; background: none; border: none; white-space: normal; line-height: normal; overflow: visible; color: rgb(0,0,0); font-size: 12px; font-family: arial;">
                                                            <div style="overflow: visible;">
                                                              <div style="overflow: visible;">
                                                                <span data-mce-mark="1" style="font-family: helvetica; font-size: 13pt;"><span style="font-family: helvetica; font-size: 12pt;">Good morning </span>'.$user->name.'</span>
                                                              </div>
                                                              <div style="overflow: visible;">
                                                                <span data-mce-mark="1" style="font-family: helvetica; font-size: 13pt;">&nbsp;</span>
                                                              </div>
                                                              <div style="overflow: visible;">
                                                                <span style="font-family: helvetica; font-size: 13pt;">'.$post->content.'</span>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td sectionid="footer" style="text-align: start; margin: 0; padding: 20px; border: none; white-space: normal; line-height: normal; background-color: rgb(255,255,255);" valign="top">
                                                      <p style="font-family:Helvetica,Arial,sans-serif;padding:0px;margin:13px 0px 0px;line-height:1.6;color:rgb(153,153,153);font-size:11px">Ellen May Institute Ruko Sentra Niaga Puri Indah Blok T1 No 12A, Puri Kembangan Jakarta Barat, Jakarta Raya Indonesia +6282327229009</p>
                                                    </td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </body>
                        </html>​';

            $recipient_email[] = [
                'recipient' => $user->user->email
            ];

            $field = [
                'subject' => $post->name,
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
    }

    public function send_email_welcome($user)
    {
        $userFullName = $user->name;

        if($userFullName == null || $userFullName == "") {
            $userFullName = "Bapak / Ibu";
        }

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
                                            <img src="https://ellen-may.com/images/email-miss-ellen-new.jpg" alt="image" width="258" style="font-family:Helvetica,Arial,sans-serif;font-size:20px;width:100%">
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
                                              <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:0px 0px 13px;line-height:1.6">Halo '.$userFullName.',<br></p>
                                              <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Selamat bergabung dengan Super Trader Signal (yang dulu namanya adalah Premium Access). Terima kasih buat kepercayaan '.$userFullName.'.</p>
                                              <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Melalui Super Trader Signal (Premium Access) ini, '.$userFullName.' akan mendapat banyak manfaat untuk:</p>
                                              <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;padding-left:20px;margin:13px 0px;line-height:1.6">1. Menentukan saham apa yang mau dibeli dan dijual, lengkap dengan harga beli dan saat jualnya.</p>
                                              <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;padding-left:20px;margin:13px 0px;line-height:1.6">2. Manajemen risiko dan juga manajemen portofolio untuk meminimalkan risiko & profit konsisten.</p>
                                              <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;padding-left:20px;margin:13px 0px;line-height:1.6">3. Edukasi yang bisa mengasah dan mempertajam rasa percaya diri Anda sebagai seorang trader.</p>
                                              <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Saat ini kami sedang melakukan transformasi / pembaruan dari Premium Access ke Super Trader Signal, sehingga system lama masih bisa digunakan untuk mem-back-up system baru.</p>
                                              <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">'.$userFullName.' akan mendapatkan akses untuk member area Super Trader Signal ID dan Telegram, sambil kami terus memperbaiki member Area yang baru, yakni Super Trader Signal.</p>
                                              <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6"><b>Berikut cara login nya ya:</b></p>
                                              <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">ID : '.$user->email.'</p>
                                              <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;padding-top:0px;line-height:1.6">Password : '. "D9RajJi6" . substr($user->phone, 0, 5).'</p>
                                              <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Member area baru (Super Trader Signal) : <a href="https://ellen-may.com/member/login">https://ellen-may.com/member/login</a></p>
                                              <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Tutorial member area baru : <a href="https://membership-media.s3-ap-southeast-1.amazonaws.com/public/uploads/tutorial/Tutorial+Penggunaan+Super+Trader+Signal+-video-v2.pdf">https://membership-media.s3-ap-southeast-1.amazonaws.com/public/uploads/tutorial/Tutorial+Penggunaan+Super+Trader+Signal+-video-v2.pdf</a></p><br>
                                              <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Akses Lama :</p>
                                              <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Meluncur ke <a href="https://premiumaccess.id/login">https://premiumaccess.id/login</a></p>
                                              <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Masukkan Email Anda : '.$user->email.'</p>
                                              <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;margin:13px 0px;line-height:1.6">Password : Q12Nx&6883</p><br>
                                              <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;padding-top:0px;line-height:1.6">Kalau '.$userFullName.' perlu bantuan, langsung saja whatsapp ke +62 817 17716877 atau bisa juga klik url berikut ini <a href="https://ellen-may.com/member/service">https://ellen-may.com/member/service</a> dengan menyebutkan nama dan email '.$userFullName.'. Client service kami akan siap membantu '.$userFullName.'.</p>
                                              <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;padding-top:0px;line-height:1.6">We make money and change lives better.</p>
                                              <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;padding-top:0px;line-height:1.6">Salam profit,</p>
                                              <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;padding-top:0px;line-height:1.6"><img src="https://d1yoaun8syyxxt.cloudfront.net/ci323-6b2f0c98-2197-46ab-8ab7-70e4af05102b-v2" alt="image" width="108" style="font-family:Helvetica,Arial,sans-serif;font-size:20px;width:18%"></p>
                                              <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;padding-top:0px;line-height:1.6">Ellen May</p>
                                              <p class="m_4178287543717492059m_8500764122952422996bard-text-block m_4178287543717492059m_8500764122952422996style-scope" style="color:rgb(52,52,52);font-family:Helvetica,Arial,sans-serif;font-size:14px;padding:0px;padding-top:0px;line-height:1.6"></p>
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
            'subject' => $userFullName.', Welcome to Super Trader Signal (Premium Access)',
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
}
