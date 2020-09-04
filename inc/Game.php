<?php

class Game
{
    //create phrase and lives properties
    private $phrase;
    private $lives = 5;

    //construct function takes phrase object and assigns it to the phrase property of Game class instance
    public function __construct(Phrase $phrase)
    {
        $this->phrase = $phrase;
    }

    //this function handles displaying the keyboard. It calls update keyboard to decide how to display individual keys
    public function displayKeyboard()
    {
        $firstRow = ['q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p'];
        $secondRow = ['a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l'];
        $thirdRow = ['z', 'x', 'c', 'v', 'b', 'n', 'm'];

        $html = '<form id="keyboard" method="post" action="play.php">
                <input class="text" type=text id=key name=key  value="" hidden/>
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

    // this function displays the lives. It loops through the lives property and displays a heart for each life
    public function displayScore()
    {
        $html = '<div id="scoreboard" class="section"><ol>';
        for($i=0; $i < $this->lives; $i++) {
            $html .= '<li class="tries"><img src="images/liveHeart.png" height="35px" widght="30px"></li>';
        }

        $html .= '</ol></div>';

        return $html;

    }

    //this function decides how to display each key on keyboard. It checks if a key passed as argument is in the selected property of phrase object,
    //if not in selected array, it displays key as normal. It then checks if key is in the array of phrase letters, if yes it displays key as a correct guess,
    //If not it displays key as incorrect letter guess
    public function updateKeyboard($key)
    {
        if(!in_array($key, $this->phrase->getSelected())){
            return '<button class="key" type="submit" name="key" value="' . $key . '">' . $key . '</button>';
        }

        if($this->phrase->checkLetter($key)) {
            return '<button class="key correct" type="submit" name="key" style="background-color: #48db73; color: white" value="' . $key . '" disabled>' . $key . '</button>';
        } else {
            return '<button class="key incorrect" type="submit" name="key" style="background-color: #ff005c; color: white" value="' . $key . '" disabled>' . $key . '</button>';
        }
    }

    //this function counts the number of wrong letters guesses
    public function getNumWrong()
    {
        $wrongLetters = array_diff($this->phrase->getSelected(), $this->phrase->getLetterArray());

        return count($wrongLetters);
    }

    //this method calculates number of lives remaining
    public function calculateLives()
    {
        $livesLeft = ($this->lives) - ($this->getNumWrong());

        $this->lives = $livesLeft;
    }

    //this method checks for win
    public function checkForWin()
    {

        $intersect = array_intersect($this->phrase->getSelected(), $this->phrase->getLetterArray());

        if(count($intersect) == count($this->phrase->getLetterArray())) {
            return true;
        } else {
            return false;
        }

    }

    //this method checks for loss
    public function checkForLose()
    {
        return $this->lives < 1;
    }

    //this method checks for win or loss and displays appropriate html for win loss screen
    public function gameOver()
    {
        if($this->checkForWin()) {
            $html = '<h1 id="game-over-message" style="color: white">';
            $html .= 'Congratulations on guessing: ' . $this->phrase->getCurrentPhrase() . '</h1>';
            $html .= '<script>  document.getElementsByTagName("body")[0].style.background = "green"; </script>';
            $html .= '<script>  document.getElementsByClassName("header")[0].style.color = "white"; </script>';
            return $html;
        } else if ($this->checkForLose()){
            $html = '<h1 id="game-over-message" style="color: white">The phrase was: ' . $this->phrase->getCurrentPhrase().  '. Better luck next time!</h1>';
            $html .= '<script>  document.getElementsByTagName("body")[0].style.background = "red"; </script>';
            $html .= '<script>  document.getElementsByClassName("header")[0].style.color = "white"; </script>';
            return $html;
        } else {
            return false;
        }



    }

}