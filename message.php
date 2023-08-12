<?php

ini_set('display_errors', 1);

class Message {
    private $date;
    private $standardTimezone;

    public function __construct(){
        $this->date = new DateTime('now', new DateTimeZone('Asia/Tokyo'));
    }

    public function getCustomMessage(){
        $hour = intval($this->date->format('H'));
        $customMessage = '';

        if ($hour >= 5 && $hour < 10) {
            $customMessage = "今日はどんな１日にしたいですか？";
        } elseif ($hour >= 10 && $hour < 18) {
            $customMessage = "どんな１日を過ごしていますか？";
        } elseif ($hour >= 18 || $hour < 0) {
            $customMessage = "どんな１日でしたか？";
        } else {
            $customMessage = "何か吐き出したい思いがありますか？";
        }

        return $customMessage;
    }
}





