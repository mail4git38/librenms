<?php
/*
 * This program is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the
 * Free Software Foundation, either version 3 of the License, or (at your
 * option) any later version.  Please see LICENSE.txt at the top level of
 * the source code distribution for details.
 *
 * @package    LibreNMS
 * @subpackage webui
 * @link       http://librenms.org
 * @copyright  2017 LibreNMS
 * @author     Cercel Valentin <crc@nuamchefazi.ro>
*/

require 'includes/graphs/common.inc.php';
$scale_min     = 0;
$colours       = 'mixed';
$unit_text     = 'Average latency';
$unitlen       = 16;
$bigdescrlen   = 25;
$smalldescrlen = 25;
$dostack       = 0;
$printtotal    = 0;
$addarea       = 1;
$transparency  = 33;
$rrd_filename = rrd_name($device['hostname'], array('app', $app['app_type'], $app['app_id']));

$array = array(
    'latency_100' => array('descr' => 'Last 100 pkts', 'colour' => 'd29ba5',),
    'latency_1000' => array('descr' => 'Last 1000 pkts', 'colour' => 'b75e6e',),
    'latency_10000' => array('descr' => 'Last 10000 pkts', 'colour' => '732634',),
    'latency_1000000' => array('descr' => 'Last 1000000 pkts', 'colour' => '521b25',),
);

$i = 0;

if (rrdtool_check_rrd_exists($rrd_filename)) {
    foreach ($array as $ds => $var) {
        $rrd_list[$i]['filename'] = $rrd_filename;
        $rrd_list[$i]['descr'] = $var['descr'];
        $rrd_list[$i]['ds'] = $ds;
        $rrd_list[$i]['colour'] = $var['colour'];
        $i++;
    }
} else {
    echo "file missing: $rrd_filename";
}

require 'includes/graphs/generic_v3_multiline_float.inc.php';
