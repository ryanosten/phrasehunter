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

    public function getNumWrong()
    {
        $wrongLetters = array_diff($this->phrase->getSelected(), $this->phrase->getLetterArray());

        return count($wrongLetters);
    }

    public function calculateLives()
    {
        $livesLeft = ($this->lives) - ($this->getNumWrong());

        $this->lives = $livesLeft;
    }

    public function checkForWin()
    {

    }

    public function checkForLose()
    {
        return $this->lives < 1;
    }

    public function gameOver()
    {
        $html = '<h1 id="game-over-message">';
        $html .= 'Congratulations on guessing: "The adventure begins"</h1>';
        $html .= '<h1 id="game-over-message">The phrase was: "The adventure begins". Better luck next time!</h1>';

        return $html;

    }




}