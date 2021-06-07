<?php
error_reporting(E_ALL);  // Turn on all errors, warnings and notices for easier debugging

// API request variables
$endpoint = 'http://svcs.ebay.com/services/search/FindingService/v1';  // URL to call
$version = '1.0.0';  // API version supported by your application
$appid = 'RobertMa-Shakopee-PRD-169ec6b8e-bb30ba02';  // Replace with your own AppID
$globalid = 'EBAY-US';  // Global ID of the eBay site you want to search (e.g., EBAY-DE)
$query = 'movies';  // You may want to supply your own query
$safequery = urlencode($query);  // Make the query URL-friendly
$i = '0';  // Initialize the item filter index to 0
// Create a PHP array of the item filters you want to use in your request
$filterarray =
    array(
        array(
            'name' => 'MaxPrice',
            'value' => '58617248617245872145781243528134654786',
            'paramName' => 'Currency',
            'paramValue' => 'USD'
        ),
        array(
            'name' => '',
            'value' => 'true',
            'paramName' => '',
            'paramValue' => ''
        ),
        array(
            'name' => 'ListingType',
            'value' => array('AuctionWithBIN', 'FixedPrice'),
            'paramName' => '',
            'paramValue' => ''
        ),
    );

// Generates an indexed URL snippet from the array of item filters
function buildURLArray($filterarray)
{
    global $urlfilter;
    global $i;
    // Iterate through each filter in the array
    foreach ($filterarray as $itemfilter) {
        // Iterate through each key in the filter
        foreach ($itemfilter as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $j => $content) { // Index the key for each value
                    $urlfilter .= "&itemFilter($i).$key($j)=$content";
                }
            } else {
                if ($value != "") {
                    $urlfilter .= "&itemFilter($i).$key=$value";
                }
            }
        }
        $i++;
    }
    return "$urlfilter";
} // End of buildURLArray function

// Build the indexed item filter URL snippet
buildURLArray($filterarray);


// Construct the findItemsByKeywords HTTP GET call
$apicall = "$endpoint?";
$apicall .= "OPERATION-NAME=findItemsByKeywords";
$apicall .= "&SERVICE-VERSION=$version";
$apicall .= "&SECURITY-APPNAME=$appid";
$apicall .= "&GLOBAL-ID=$globalid";
$apicall .= "&keywords=$safequery";
$apicall .= "&paginationInput.entriesPerPage=50";
$apicall .= "$urlfilter";
// Load the call and capture the document returned by eBay API
$resp = simplexml_load_file($apicall);

// Check to see if the request was successful, else print an error
if ($resp->ack == "Success") {
    $results = '';
    // If the response was loaded, parse it and build links
    foreach ($resp->searchResult->item as $item) {
        $pic   = $item->galleryURL;
        $link  = $item->viewItemURL;
        $title = $item->title;
        /////////////////////////EDIT THIS LINE/////////////////////////////////////////////////////
        // For each SearchResultItem node, build a link and append it to $results
        if($i % 4 === 1){
        $results .= "$price<div class='row'><div class='col'><span>$price</span><img src=\"$pic\"><a href=\"$link\">$title</a></div>";
        }
        if($i % 4===2 || $i % 4 === 3){
            $results .= "<div class='col'><td><img src=\"$pic\"><a href=\"$link\">$title</a></div>";
        }
        if($i % 4===0 ){
            $results .= "<div class='col'><img src=\"$pic\"><a href=\"$link\">$title</a></div></div>";
        }

        ////////////////////////EDIT THIS LINE//////////////////////////////////////////////////////      
    }
}
// If the response does not indicate 'Success,' print an error
else {
    $results  = "<h3>Oops! The request was not successful. Make sure you are using a valid ";
    $results .= "AppID for the Production environment.</h3>";
}
?>
<!-- Build the HTML page with values from the call response -->
<html>

<head>
<menu>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a href="http://shakonet.isd720.com" class="navbar-brand">WebDev</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav">
                    <!--↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Edit These Items in your Menu ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓-->
                    <a href="login.php" class="nav-item nav-link">Home</a>
                    <a href="emojimovie.html" class="nav-item nav-link ">Bad movie</a>
                    <a href="soul.html" class="nav-item nav-link ">Soul</a>
                    <a href="okmovie.html" class="nav-item nav-link">ok movie</a>
                    <a href="goodmovie2.html" class="nav-item nav-link">another good movie</a>
                    <a href="CRUD/phpDemo-master/index.php" class="nav-item nav-link">CRUD</a>
                    <a href="eBayAPI.php" class="nav-item nav-link active">Other movies</a>
                    <!--↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Edit These Items in your Menu ↑↑↑↑↑↑↑↑↑↑↑↑↑↑-->
                </div>
                <div class="navbar-nav ml-auto">
                    <a href="#" class="nav-item nav-link disabled">Login</a>
                </div>
            </div>
        </nav>
    </menu>
    <title>eBay Search Results for <?php echo $query; ?></title>
    <style type="text/css">
        body {
            font-family: arial, sans-serif;
        }

        tbody {
            border: 1px black;
        }
    </style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="CSS/style.css">
</head>

<body>

    <h1>eBay Search Results for <?php echo $query; ?></h1>

    <div class="container-fluid">
        <div class="row">
            
                <?php echo $results; ?>
            
        </div>
    </div>
</body>

</html>