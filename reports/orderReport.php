<?php

// Receive customer MWS credentials

require("mwscredentials.php");

// Request report for API request

require("amazonRequestReport.php");

// Get Report Request ID

$requestId = $reportRequestId['RequestReportResult']['ReportRequestInfo']['ReportRequestId'];
sleep(20);

// Request GetReportRequestListResult

require("amazonReportRequestList.php");

// Get Report Status

$reportStatus = $reportDetails['GetReportRequestListResult']['ReportRequestInfo']['ReportProcessingStatus'];

// Check if report is done
if($reportStatus != "_DONE_"){
  sleep(20);
  require("amazonReportRequestList.php");
}


if($reportStatus === "_DONE_"){

$generatedReportId = $reportDetails['GetReportRequestListResult']['ReportRequestInfo']['GeneratedReportId'];

// Check if Report ID available, if not do something

  if(!$generatedReportId) {
    echo "No Report ID available";
  }

// If report ID is available, do:

require("amazonGetReport.php");

} else {
  // if report status is not DONE:
    echo "Report Status: $reportStatus";
}

header("Location: http://www.sendjapan.com/amazon/orders.php");
