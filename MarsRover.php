<?php

class MarsRover
{
    // declare axis coordinates
    private $x = 0;
    private $y = 0;

    // set default facing to 1 which is North
    private $facing = 1;

    // set array to make it possible to determine
    // whether rover turns left or right later in the code
    private $facingArray = [
        'N' => 1,
        'E' => 2,
        'S' => 3,
        'W' => 4
    ];

    // create constructor to set initial position
    function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    // create function to show second position (user input)
    function setPosition(int $x, int $y, string $facing)
    {
        $this->x = $x;
        $this->y = $y;

        if (array_key_exists($facing, $this->facingArray)) {
            $this->facing = $this->facingArray[$facing];
        } else {
            // if cardinal isn't N,S,E or W stop the execution
            exit('Input not recognised');
        }
    }

    function printPosition()
    {
        $direction = 'N';
            if ($this->facing == 1) {
                $direction = 'N';
            } else if ($this->facing == 2) {
                $direction = 'E';
            } else if ($this->facing == 3) {
                $direction = 'S';
            } else if ($this->facing == 4) {
                $direction = 'W';
            } else {
                exit("Unrecognised cardinal");
            }
        echo $this->x  . " " .  $this->y . " " . $direction . PHP_EOL;
    }

    // pass in the string with L, R, M to loop
    // and do the actual spin/moves
    function spinOrMove(string $coordinates)
    {
        for ($i = 0; $i < strlen($coordinates); $i++) {
            $this->setMovement(substr($coordinates, $i, 1));
        }
    }

        // sets movement L, R, M
    function setMovement($movement)
    {
        if ($movement == 'L') {
            $this->turnLeft();
        } else if ($movement == 'R') {
            $this->turnRight();
        } else if ($movement == 'M') {
            $this->moveForward();
        } else {
            echo "Unrecognised movement";
        }
    }

    // sets heading
    function moveForward()
    {
        if ($this->facing == 1) {
            $this->y++;
        } else if ($this->facing == 2) {
            $this->x++;
        } else if ($this->facing == 3) {
            $this->y--;
        } else if ($this->facing == 4) {
            $this->x--;
        }
    }

    function turnLeft()
    {
        // 1 = North, 4 = West
        // we know that the facing default is North
        $this->facing = ($this->facing - 1) < 1 ? 4 : $this->facing - 1;
    }

    function turnRight()
    {
        $this->facing = ($this->facing + 1) > 4 ? 1 : $this->facing + 1;
    }
}
  // initialise starting point
  $MarsRover = new MarsRover(5, 5);

  // input for first rover
  $MarsRover->setPosition(1, 2, 'N');
  $MarsRover->spinOrMove("LMLMLMLMM");
  $MarsRover->printPosition();

  // input for second rover
  $MarsRover->setPosition(3, 3, 'E');
  $MarsRover->spinOrMove("MMRMMRMRRM");
  $MarsRover->printPosition();


  /*
    Other things the mars rovers can do:
    1. Display movement history.
    2. Program a set of instructions to follow.
    3. Implement a self-destruction command.
    4. Implement AI to communicate back information.
    5. Collect information such as temperature.
    6. Create a written report of information found.
  */

?>
