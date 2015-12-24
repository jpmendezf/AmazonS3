<?php    
    require_once 'amazon-s3/vendor/autoload.php';
    
use Aws\Common\Aws;
use Aws\S3\S3Client;
use Aws\Common\Credentials\Credentials;



/**
* class for amazon s3
*/
class AmazonS3
{
    private $aws_access_key_id_string;
    private $aws_secret_access_key_string;
    private $client,$credentials;
    function __construct($access_key,$secret_access_key)
    {
        $this->aws_access_key_id_string=$access_key;
        $this->aws_secret_access_key_string=$secret_access_key;
    }

    public function setCredentials()
    {
        $this->credentials = new Credentials($this->aws_access_key_id_string,$this->aws_secret_access_key_string);
        $this->client = S3Client::factory(array(
        'credentials' => $this->credentials
        ));

    }

    public function uploadFileS3($bucket,$file_name,$pathToFile)
    {
       $result = $this->client->putObject(array(
        'Bucket'     => $bucket,
        'Key'        => $file_name,
        'SourceFile' => $pathToFile,
        'ACL'    => 'public-read'
        ));

        return $result['ObjectURL'];
 
    }

    public function createBucketS3($bucket)
    {
        $result = $client->createBucket(['Bucket' => $bucket]);
    }

    public function listBucketS3()
    {
        $result = $client->listBuckets();
    }
    function fileURLS3($bucket,$file_name)
    {
        $url = $this->client->getObjectUrl($bucket, $file_name);
        return $url;
    }


}
