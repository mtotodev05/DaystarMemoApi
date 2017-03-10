<?php
/**
 * Created by PhpStorm.
 * User: arin
 * Date: 3/9/17
 * Time: 11:14 AM
 */

use \Illuminate\Http\UploadedFile;

class MemoTest extends TestCase
{
    /*
     * Testing the Get Request for all memos
     */
    public function testGetMemos()
    {
        $this->get('/api/memos')->assertResponseStatus(200);
    }

    public function testPostMemos()
    {
        //Testing for proper parameters and saving
        $this->json('POST', '/api/memos', ['user_id' => 1, 'memo_body' => 'Memo Test Assertion', 'to' => 1])->assertResponseStatus(200);
        /*
         * Testing saving including the file uploads.
         * Remember to copy another image in the directory storage/testing since the MemoController moves file to intended location
         * Rename the image image.jpg
         */
        $file = new UploadedFile(storage_path('testing/image.jpg'),'image.jpg', filesize(storage_path('testing/image.jpg')), 'image/jpg', null, true);
        $this->json('POST', '/api/memos', ['user_id' => 1, 'memo_body' => 'Working on Coverage', 'to' => 1, 'file' => $file])->assertResponseStatus(200);

        // Testing for wrong input or too few parameters
        $this->json('POST', 'api/memos')->assertResponseStatus(403);
        $this->json('POST', 'api/memos', ['user_id' => 2])->assertResponseStatus(403);
        $this->json('POST', 'api/memos', ['user_id' => 2, 'memo_body' => 'Crazy Tests'])->assertResponseStatus(403);
        $this->json('POST', 'api/memos', ['user_id' => 'e', 'memo_body' => 'Tests huh!', 'to' => 'e'])->assertResponseStatus(403);
        $this->json('POST', 'api/memos', ['user_id' => 3, 'memo_body' => 'Tests Again!', 'to' => 1])->assertResponseStatus(400);
        $this->json('POST', 'api/memos', ['user_id' => 1, 'memo_body' => 'Tests Lord Have Mercy!', 'to' => 5])->assertResponseStatus(400);

    }
}