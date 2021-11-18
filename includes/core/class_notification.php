<?php

class Notification {

    // TEST

    public static function push($user_id, $title, $description) {
        $q = "INSERT INTO user_notifications (user_id, title, description, created) VALUES ({$user_id}, '{$title}', '{$description}',".time().")";
        DB::query($q);
    }

    public static function owner_get($data = []) {
        $select = "SELECT title, description, viewed, created FROM user_notifications";
        $where = "WHERE user_id=".Session::$user_id." ";
        if ($data['unread_flag'] == 1) $where .= "AND viewed=0 ";
        $list = [];
        $q = DB::query($select.$where.";");
        if ($rows = DB::fetch_all($q)) {
            foreach ($rows as $row) {
                $list[] = [
                    'title' => $row['title'],
                    'descriptioin' => $row['description'],
                    'viewed' => $row['viewed'],
                    'created' => $row['created']
                ];
            }
        }
        return $list;
    }

    public static function owner_read() {
        try {
            $q = "UPDATE user_notifications SET viewed=1 WHERE viewed=0 AND user_id=".Session::$user_id;
            DB::query($q);
            return true;
        } catch (Throwable $e) {
            response(error_response(1005, 'request failed'));
        }
    }

}
