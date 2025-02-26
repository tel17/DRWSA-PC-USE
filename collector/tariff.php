<?php
// Include the database connection file
// Database connection

include("dbcon.php");


if (isset($_GET['consumedCuM']) && isset($_GET['usageType'])) {
    $consumedCuM = (float) $_GET['consumedCuM'];
    $usageType = $_GET['usageType'];

    if ($usageType == 'commercial_a') {
        $usageType = 'Commercial A';
    } elseif ($usageType == 'commercial_b') {
        $usageType = 'Commercial B';
    }

    $tariffData = getCurrentTariffRates($con);
    $tariff = calculateTariff($consumedCuM, $tariffData, $usageType);

    header('Content-Type: application/json');
    echo json_encode(['tariff' => $tariff]);
    exit();
}

function getCurrentTariffRates($con) {
    $residentialQuery = "SELECT * FROM tb_tariff WHERE category = 'residential'";
    $commercialQuery = "SELECT * FROM tb_commercial_tariff WHERE category IN ('Commercial A', 'Commercial B')";

    $residentialResult = $con->query($residentialQuery);
    $commercialResult = $con->query($commercialQuery);

    if (!$residentialResult || !$commercialResult) {
        http_response_code(500);
        echo "Failed to retrieve tariff rates: " . $con->error;
        exit();
    }

    $currentTariffs = [];

    while ($row = $residentialResult->fetch_assoc()) {
        $currentTariffs[] = [
            'category' => $row['category'],
            'first' => $row['first'],
            'second' => $row['second'],
            'third' => $row['third'],
            'fourth' => $row['fourth'],
            'fifth' => $row['fifth'],
            'sixth' => $row['sixth'],
            'last' => $row['last']
        ];
    }

    while ($row = $commercialResult->fetch_assoc()) {
        $currentTariffs[] = [
            'category' => $row['category'],
            'first' => $row['first'],
            'second' => $row['second'],
            'third' => $row['third'],
            'fourth' => $row['fourth'],
            'last' => $row['last']
        ];
    }

    return $currentTariffs;
}



function calculateTariff($consumedCuM, $tariffData, $usageType) {
    $tariff = null;
    foreach ($tariffData as $data) {
        if ($data['category'] == $usageType) {
            $tariff = $data;
            break;
        }
    }

    if ($tariff === null) {
        http_response_code(500);
        echo "Failed to retrieve tariff rates for $usageType";
        exit();
    }

    if ($usageType == 'residential') {
        if ($consumedCuM <= 5) {
            return $tariff['first'];
        } elseif ($consumedCuM <= 10) {
            return ($tariff['second'] * ($consumedCuM - 5)) + $tariff['first'];
        } elseif ($consumedCuM <= 20) {
            return ($tariff['third'] * ($consumedCuM - 10)) + ($tariff['second'] * 5) + $tariff['first'];
        } elseif ($consumedCuM <= 30) {
            return ($tariff['fourth'] * ($consumedCuM - 20)) + ($tariff['third'] * 10) + ($tariff['second'] * 5) + $tariff['first'];
        } elseif ($consumedCuM <= 40) {
            return ($tariff['fifth'] * ($consumedCuM - 30)) + ($tariff['fourth'] * 10) + ($tariff['third'] * 10) + ($tariff['second'] * 5) + $tariff['first'];
        } elseif ($consumedCuM <= 50) {
            return ($tariff['sixth'] * ($consumedCuM - 40)) + ($tariff['fifth'] * 10) + ($tariff['fourth'] * 10) + ($tariff['third'] * 10) + ($tariff['second'] * 5) + $tariff['first'];
        } else {
            return ($tariff['last'] * ($consumedCuM - 50)) + ($tariff['sixth'] * 10) + ($tariff['fifth'] * 10) + ($tariff['fourth'] * 10) + ($tariff['third'] * 10) + ($tariff['second'] * 5) + $tariff['first'];
        }
    } elseif ($usageType == 'Commercial A' || $usageType == 'Commercial B') {
        // This will handle both 'Commercial A' and 'Commercial B'
        if ($consumedCuM <= 15) {
            return $tariff['first'];
        } elseif ($consumedCuM <= 30) {
            return ($tariff['second'] * ($consumedCuM - 15)) + $tariff['first'];
        } elseif ($consumedCuM <= 500) {
            return ($tariff['third'] * ($consumedCuM - 30)) + ($tariff['second'] * 15) + $tariff['first'];
        } elseif ($consumedCuM <= 1000) {
            return ($tariff['fourth'] * ($consumedCuM - 500)) + ($tariff['third'] * 470) + ($tariff['second'] * 15) + $tariff['first'];
        } else {
            return ($tariff['last'] * ($consumedCuM - 1000)) + ($tariff['fourth'] * 500) + ($tariff['third'] * 470) + ($tariff['second'] * 15) + $tariff['first'];
        }
    }
}
?>