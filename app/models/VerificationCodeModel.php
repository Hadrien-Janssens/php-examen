<?php
function getRegleVerificationCode() {
    return [
        "verification_code" => [
            "require" => true,
            "max" => 5,
            "min" => 5
        ]
    ];
}
 

?>