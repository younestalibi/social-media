
    
    <?php
      // Cut and Paste PHP Code
      require 'vendor/autoload.php';    // Composer auto-loader
      
      $client = new GuzzleHttp\Client();
      $res = $client->request(
          'POST',
          'https://app.ayrshare.com/api/post',
          [
              'headers' => [
                  'Content-Type' => 'application/json',
                  // Live API Key
                  'Authorization' => 'Bearer 22S3KFC-RH14NFT-MYKJ6ME-CVJNNB4'
              ],
              'json' => [
                  'post' => 'Today is a great day!',
                  'platforms' => ['twitter', 'facebook', 'instagram', 'linkedin', 'telegram'],
                  'mediaUrls' => ['https://images.ayrshare.com/imgs/GhostBusters.jpg'],
              ]
          ]
      );
      
      echo json_encode(json_decode($res->getBody()), JSON_PRETTY_PRINT); 
      ?>
    
