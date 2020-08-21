<?php

class Phrase
{

    private $currentPhrase;
    private $selected= [];

    public function __construct($phrase = null, $selected = null)
    {
        if (!empty($phrase)) {
            $this->currentPhrase = $phrase;
        } else {
            $this->currentPhrase = 'Dream Big Little One';
        }

        if (!empty($selected)) {
            $this->selected = $selected;
        }
    }

    public function addPhraseToDisplay()
    {

        $characters = str_split(strtolower($this->currentPhrase));

        //builds the HTML for the letters of the phrase
        $html = '<div id="phrase" class="section">';
        $html .= '<ul>';

        foreach ($characters as $char) {
            if (ctype_space($char)) {
                $html .= '<li class="hide space"> </li>';
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

    public function checkLetter()
    {

    }

}