<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * This example gets all saved reports for the default account.
 *
 * Tags: reports.saved.list
 */
class GetAllSavedReports {
  /**
   * Gets all saved reports for the default account.
   *
   * @param $service Google_Service_AdExchangeSeller AdExchange Seller service
   *     object on which to run the requests.
   * @param $maxPageSize int the maximum page size to retrieve.
   * @return array the last page of saved reports.
   */
  public static function run($service, $maxPageSize) {
    $separator = str_repeat('=', 80) . "\n";
    print $separator;
    print "Listing all saved reports for the default account\n";
    print $separator;

    $optParams['maxResults'] = $maxPageSize;

    $pageToken = null;
    $savedReports = null;
    do {
      $optParams['pageToken'] = $pageToken;
      $result = $service->reports_saved->listReportsSaved($optParams);
      if (!empty($result['items'])) {
        $savedReports = $result['items'];
        foreach ($savedReports as $savedReport) {
          printf("Saved report with id \"%s\" and name \"%s\" was found.\n",
              $savedReport['id'], $savedReport['name']);
        }
        if (isset($result['nextPageToken'])) {
          $pageToken = $result['nextPageToken'];
        }
      } else {
        print "No saved reports found.\n";
      }
    } while ($pageToken);
    print "\n";

    return $savedReports;
  }
}
