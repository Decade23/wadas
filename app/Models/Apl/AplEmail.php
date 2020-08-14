<?php

namespace App\Models\Apl;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use App\Services\Backend\Media\MediaServicesContract;

/**
 * Class AplEmail
 * @package App\Models\Apl
 */
class AplEmail extends Model
{
    private $mediaServices;
    /**
     * @var string
     */
    protected $table = 'apl_email';

    /**
     * @var array
     */
    protected $fillable = [
        'from', 'recipient', 'group','cc', 'bcc', 'title', 'body', 'attachment', 'status', 'id_mailgun', 'created_by', 'updated_by'
    ];

    /**
     * @param $value
     * @return false|string
     */
    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d H:i:s', strtotime($value));
    }

    /**
     * @param $value
     * @return false|string
     */
    public function getUpdatedAtAttribute($value){
        return date('Y-m-d H:i:s', strtotime($value));
    }

    public function getAttachmentsMediaAttribute(){
        $result = array();
        //dd(  json_decode($value)  );
        $attachments = json_decode($this->attachment);
        if ( is_array( $attachments ) ) {
            # code...
            foreach( $attachments as $attachment ) {
                #$result[] = $this->mediaServices->getMediaByFileName($attachment);
                $result[] = Media::where('file_name', $attachment )->first();
            }
        }

        return $result;
    }

    // public function attachments()
    // {
    //     return $this->hasMany(Media::class, 'attachment', 'file_name');
    // }
}
