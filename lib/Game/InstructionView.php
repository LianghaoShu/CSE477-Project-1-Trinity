<?php
/**
 * Created by PhpStorm.
 * User: Ze Liu
 * Date: 2/15/2019
 * Time: 13:21
 */

namespace Game;


class InstructionView
{


    public function __construct()
    {

    }

    public function presentInstruction(){
        $html = <<<HTML
        <p>There are 6 Suspects:Prof.Owen, Prof.McCullen, Prof.Onsay, Prof.Enbody, Prof.Plum, Prof.Day. </p>
<p>There are 6 Weapons: Final Exam, Midterm Exam, Programming Assignment, Project, Written Assignment, Quiz.</p>
<p>There are 21 cards: 6 suspects cards, 6 weapons cards, and 9 locations cards.  </p>
<p>
    In this game you are going to get the accusation right. Players select tokens from suspects. The system selects one
    of each as the murderer, weapon, and location. The remaining cards are dealt to the players, with a maximum of 6
    cards per player. If there are two players, each player gets 6 cards and the computer holds 6. Each of these cards is
    assigned a word. The words are different for each player. The player keeps their printed card sheet secret. The computer
    will use your code word to communicate a card to you in response to a suggestion.The process repeats for each player.
    Each player prints their cards sheet. </p>
    <p>The player roll dice to dicide how many piece he can move. The rules of movement are
    that a path must only move horizontally or verically from each square. Pieces can only enter a room though the openings when
    they reach the building.  By clicking in the Building, player moves into the building. Now ther are three options: Pass(ending
    the turn), Suggetst(make a suggestion), Accuse(make a accusation). If player chooes to make suggestion, he is presentd with the
    possible suspects(there are 6 possibilities). Then player can select one suspect and clicks Go. This is saying I think the murderer
    was xxx. Then suspect would also move into the room. Then the player choose a weapon from six possible options. The player looks at their sheet. They see the word 'blowhole' is under the card for this Building. </p>
        <p>That player now knows that the crime
    could not have taken place in this building. The word that is shown is for some one of the three parts of the suggestion that are
    being held by another player or the computer and are not part of the secret. If no such card exists, the system says I got nothing.
    Note that this does not imply that the player has found the secret! When click Go, we move to the next player's turn. An accusation
    gets one of two responses: if the player got the accusation right, the player wins and the game is over. If the player got it wrong,
    that player continues to play, but can no longer make accusations, only suggestions! Effectively, that player has lost.
</p>
HTML;
        return $html;

    }
}