<?php

class Song
{
    /**
     * @var string;
     */
    private $artistName;
    /**
     * @var string
     */
    private $songName;
    /**
     * @var int
     */
    private $minutes;
    /**
     * @var int
     */
    private $seconds;

    /**
     * Song constructor.
     * @param string $songArtist
     * @param string $songName
     * @param string $songLength
     * @throws Exception
     */
    public function __construct(string $songArtist, string $songName, string $songLength)
    {
        $this->setArtistName($songArtist);

        $this->setSongName($songName);

        $this->setLength($songLength);

    }


    /**
     * @param string $artistName
     * @throws Exception
     */
    public function setArtistName(string $artistName): void
    {
        if (strlen($artistName) < 3 || strlen($artistName) > 20) {
            throw new Exception("Artist name should be between 3 and 20 symbols.\n");
        }
        $this->artistName = $artistName;
    }

    /**
     * @param string $songName
     * @throws Exception
     */
    public function setSongName(string $songName): void
    {
        if (strlen($songName) < 3 || strlen($songName) > 30) {
            throw new Exception("Song name should be between 3 and 30 symbols.\n");
        }
        $this->songName = $songName;
    }

    /**
     * @param string $length
     * @throws Exception
     */
    public function setLength(string $length): void
    {
        $length = explode(':', $length);
        if (count($length) != 2) {
            throw new Exception("Invalid song length.\n");
        }

        $minutes = $length[0];
        $seconds = $length[1];

        $this->setMinutes($minutes);

        $this->setSeconds($seconds);
    }

    /**
     * @param int $minutes
     * @throws Exception
     */
    public function setMinutes(int $minutes): void
    {
        if ($minutes < 0 || $minutes > 14) {
            throw new Exception("Song minutes should be between 0 and 14.\n");
        }
        $this->minutes = $minutes;
    }

    /**
     * @param int $seconds
     * @throws Exception
     */
    public function setSeconds(int $seconds): void
    {
        if ($seconds < 0 || $seconds > 59) {
            throw new Exception("Song seconds should be between 0 and 59.\n");
        }
        $this->seconds = $seconds;
    }

    /**
     * @return int
     */
    public function getMinutes(): int
    {
        return $this->minutes;
    }

    /**
     * @return int
     */
    public function getSeconds(): int
    {
        return $this->seconds;
    }


}

$n = intval(readline());
$songsAdded = 0;
$songs = [];

for ($i = 0; $i < $n; $i++) {
    $input = readline();
    $song = explode(';', $input);


        $songArtist = $song[0];
        $songName = $song[1];
        $songLength = $song[2];
        $song = new Song($songArtist, $songName, $songLength);
        echo "Song added.\n";
        $songs[] = $song;
        $songsAdded++;

}

echo "Songs added: $songsAdded" . PHP_EOL;

$totalSecs = 0;

foreach ($songs as $song) {
    /**
     * @var Song $song
     */
    $totalSecs += $song->getMinutes() * 60;
    $totalSecs += $song->getSeconds();
}

$hours = sprintf("%01d", $totalSecs / 3600);
$minutes = sprintf("%02d", ($totalSecs % 3600) / 60);
$seconds = sprintf("%02d", $totalSecs % 60);


echo 'Playlist length: ' . $hours . 'h ' . $minutes . 'm ' . $seconds . 's';