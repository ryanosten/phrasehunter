<?php

class Phrase
{

    private $currentPhrase;
    private $selected = [];
    public $phrases = [
        'Boldness be my friend',
        'Leave no stone unturned',
        'Broken crayons still color',
        'The adventure begins',
        'Love without limits'
    ];

    //why does study guide advise to display $phrases property as public. I thought best practice was to make these private

    //constructor function for Phrase. Takes $phrase and $selected args. If phrase empty, grabs random phrase from $phrases property.
    public function __construct($phrase = null, $selected = null)
    {
        if (!empty($phrase)) {
            $this->currentPhrase = strtolower($phrase);
        } else {
            $rand_key = array_rand($this->phrases);
            $this->currentPhrase = $this->phrases[$rand_key];
        }

        if (!empty($selected)) {
            $this->selected = $selected;
        }
    }

    //handles adding phrase to the page. Checks if any elements in selected property are also in currentPhrase. If yes, it displays the letter
    public function addPhraseToDisplay()
    {

        $characters = str_split(strtolower($this->currentPhrase));

        //builds the HTML for the letters of the phrase
        $html = '<div id="phrase" class="section">';
        $html .= '<ul>';

        foreach ($characters as $char) {
            if (ctype_space($char)) {
                $html .= '<li class="hide space"> </li>';
            } else if (in_array($char, $this->selected)) {
                $html .= '<li class="show letter ' . $char . '">' . $char .'</li>';
            } else {
                $html .= '<li class="hide letter ' . $char . '">' . $char .'</li>';
            }
        }

        $html .= '</ul>';
        $html .= '</div>';

        return $html;
    }

    public function getCurrentPhrase()
    {
        return $this->currentPhrase;
    }

    public function setSelected($letter)
    {
        $this->selected[] = $letter;
    }

    public function getSelected()
    {
        return $this->selected;
    }

    //this function returns an array of unique characters in the currentPhrase
    public function getLetterArray()
    {
        $uniqueLetters = array_unique(str_split(str_replace(' ', '', $this->currentPhrase)));


        return $uniqueLetters;
    }

    //this function takes a letter as arg and checks if letter exists in curentPhrase by calling getLetterArray. If yes it returns true.
    public function checkLetter($letter)
    {
        $uniqueLetters = $this->getLetterArray();

        return in_array($letter, $uniqueLetters);

    }
    

}