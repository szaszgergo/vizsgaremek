<?php
    require('../sqlcall.php');

    $data = json_decode(file_get_contents("php://input"), true);
    $userId = $data['userId'] ?? null;

    if ($userId) {
        $result = sqlcall("SELECT uProfilePic FROM user WHERE uID = ?", "i", [$userId]);
        $row = $result->fetch_assoc();

        if (!empty($row['uProfilePic'])) {
            $profilePicPath = "profile_pic/" . $row['uProfilePic'];
            
            if (file_exists($profilePicPath)) {
                unlink($profilePicPath);
            }

            sqlsave("UPDATE user SET uProfilePic = NULL WHERE uID = ?", "i", [$userId]);

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Nincs képe']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Hibás uID']);
    }


?>