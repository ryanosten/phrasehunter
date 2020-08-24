<?php

class Game
{
    private $phrase;
    private $lives = 5;

    public function __construct(Phrase $phrase)
    {
        $this->phrase = $phrase;
    }

    public function displayKeyboard()
    {
        $firstRow = ['q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p'];
        $secondRow = ['a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l'];
        $thirdRow = ['z', 'x', 'c', 'v', 'b', 'n', 'm'];

        $html =
            '<form method="post" action="play.php">
                <div id="qwerty" class="section">
                    <div class="keyrow">';
        foreach ($firstRow as $key) {
            $html .= $this->updateKeyboard($key);
        }

        $html .= '</div>';

        $html .= '<div class="keyrow">';

        foreach ($secondRow as $key) {
            $html .= $this->updateKeyboard($key);
        }
        $html .= '</div>';

        $html .= '<div class="keyrow">';

        foreach ($thirdRow as $key) {
            $html .= $this->updateKeyboard($key);
        }

        $html .= '</div></div></form>';

        return $html;

    }

    public function displayScore()
    {
        $html = '
            <div id="scoreboard" class="section">
                <ol>
                ';
        for($i=0; $i < $this->lives; $i++) {
            $html .= '<li class="tries"><img src="images/liveHeart.png" height="35px" widght="30px"></li>';
        }

        $html .= '
            </ol>
        </div>
        ';

        return $html;

    }

    public function updateKeyboard($key)
    {
        if(!in_array($key, $this->phrase->getSelected())){
            return '<button class="key" type="submit" name="key" value="' . $key . '">' . $key . '</button>';
        }

        if($this->phrase->checkLetter($key)) {
            return '<button class="key correct" type="submit" name="key" style="background-color: green" value="' . $key . '" disabled>' . $key . '</button>';
        } else {
            return '<button class="key incorrect" type="submit" name="key" style="background-color: red" value="' . $key . '" disabled>' . $key . '</button>';
        }
    }

    public function checkForWin()
    {

    }

    public function checkForLose()
    {

    }

    public function gameOver()
    {

    }




}