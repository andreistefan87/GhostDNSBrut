<?php
/**
 * Created by PhpStorm.
 * User: marcosmx
 * Date: 29/10/17
 * Time: 15:17
 */

class WebInterface
{
    private $Content;
    private $Count;
    private $Result;

    public function __construct()
    {
        $this->Content = "";
        $this->Count = 0;
        $this->Result = array();
    }

    public function ParseCrawledData()
    {
        $this->Content = file_get_contents("../application/logs/found/crawled.log");
        foreach (explode("\n", $this->Content) as $Line) {
            if (strpos($Line, "|") !== false) {
                $Data = explode("|", $Line);
                $this->Result[$this->Count]["ip"] = $Data[0];
                if (isset($Data[1]) && !empty($Data[1])) {
                    $this->Result[$this->Count]["title"] = $Data[1];
                } else {
                    $this->Result[$this->Count]["title"] = "empty";
                }
                if (isset($Data[2]) && !empty($Data[2])) {
                    $this->Result[$this->Count]["header"] = $Data[2];
                } else {
                    $this->Result[$this->Count]["header"] = "empty";
                }

                if (isset($Data[2]) && !empty($Data[3])) {
                    $this->Result[$this->Count]["body"] = $Data[3];
                }else {
                    $this->Result[$this->Count]["body"] = "empty";
                }
                $this->Count++;
            }
        }
    }

    public function FoundedIpsCount()
    {
        return count($this->Result);
    }


    public function ContentByTitle($Title)
    {
        $Result = array();
        $Count  = 0;
        foreach ($this->Result as $Item )
        {
            if ($Item["title"] == urldecode($Title) )
            {
                $Count++;
                $Result[] = $Item;
            }
        }
        return ($Result);
    }

    public function CountByTitle()
    {
        $Result = array();
        $Count  = 1;
        $Model  = array();
        foreach ($this->Result as $Item )
        {
            if ( !in_array($Item["title"],$Result )  )
            {
                $Result[]               = $Item["title"];
                $Model[$Item["title"]]  = $Count;
            } else {
                $Model[$Item["title"]] = count($this->ContentByTitle($Item["title"]));
            }
        }
        arsort($Model);
        return ($Model);
    }
    public  function BlockTitle($Title)
    {
        file_put_contents("../application/class/web/blockedtitles",$Title."\r\n",FILE_APPEND);
    }

    public  function CleanLogs()
    {
        @unlink("../application/logs/found/crawled.log");
    }
}


