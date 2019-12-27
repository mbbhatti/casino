<?php

namespace App\Builder;

class Casino implements CasinoInterface
{
    /**
     * Use for total wins.
     *
     * @var int
     */
    protected $totalWin;

    /**
     * Use for board symbols.
     *
     * @var array
     */
    protected $board;

    /**
     * Use for board matrix.
     *
     * @var array
     */
    protected $matrix;      

    /**
     * Create a new class instance.
     */
    public function __construct()
    {          
        $this->totalWin = 0;
        $this->board = [];
        $this->matrix = [];

        // Call create board method       
        $this->createBoard(); 
    }

    /**
     * Create board with random symbols.
     *
     * @return void
     */
    public function createBoard(): void
    {   
        // Set default values
        $rows = 3;
        $columns = ($rows * 2 - 1);     
        $boradSize = $columns * $rows;
        $diagonalA = [];
        $diagonalB = [];
        $diagonalColumns = $columns - 1;
        $diagonalRows = $rows - 1;
        $boardSymbols = ['9','10','J','Q','K','A','cat','dog','monkey','bird'];

        for ($i = 0; $i < $rows; $i++) {
            for ($j = $i; $j < $boradSize; $j += 3) {
                // Create row matrix
                $this->matrix[$i][] = $j;

                // Get board symboles
                $this->board[$j] = $boardSymbols[array_rand($boardSymbols)];
            }  

            // Create diagonal A matrix
            array_push($diagonalA, $i * $diagonalColumns);          
            $diagonalTop = ($rows * $diagonalColumns) - ($i * $diagonalRows);
            if(!in_array($diagonalTop, $diagonalA)) {
                array_push($diagonalA, $diagonalTop);        
            }   

            // Create diagonal B matrix
            array_push($diagonalB, ($rows * $diagonalRows) - ($i * $diagonalRows));
            $diagonalBottom = ($rows * $diagonalRows) + ($i * $diagonalColumns);
            if(!in_array($diagonalBottom, $diagonalB)) {
                array_push($diagonalB, $diagonalBottom);
            }   
        }

        // Sort diagonals
        sort($diagonalA);
        sort($diagonalB);       

        //Merge diagonal with matrix
        $this->matrix = array_merge($this->matrix, [$diagonalA, $diagonalB]);       
    }

    /**
     * Get board paylines.
     *
     * @return array
     */
    public function getPayLines(): array 
    {
        $payLines  = []; 
        foreach ($this->matrix as $key => $row) {                                               
            $consecutive = 0;
            $previous = null;
            foreach ($row as $value) {
                if ($previous === null) {
                    $previous = $this->board[$value];
                    $consecutive++;         
                } else {
                    if ($previous === $this->board[$value]) {
                        $consecutive++;
                    } else {
                        if ($consecutive < 3) {
                            $consecutive = 0;
                            $previous = null;                           
                        } else {
                            $previous = $this->board[$value];
                        }
                    }
                }
            }   

            // Check payout is based on 3 or more consecutive symbols 
            if($consecutive >= 3) {             
                $payLines[][join(",",$row)] = $consecutive;

                // Call calculate total win method
                $this->calculateTotalWin($consecutive);
            }
        }

        return $payLines;    
    }

    /**
     * Calculate consecutive payline wins
     *
     * @param int  $number  consecutive
     * @return void
     */
    public function calculateTotalWin(int $number): void
    {       
        switch ($number) {
            case '5':
                $this->totalWin += 1000;
                break;
            case '4':
                $this->totalWin += 200;
                break;
            default:
                $this->totalWin += 20;
                break;
        }
    }

    /**
     * Get board payout response
     *
     * @return array
     */
    public function getPayout(): array
    {
        return [
            'board' => [implode(",",$this->board)],
            'paylines' => $this->getPayLines(),
            'bet_amount' => 100,
            'total_win' => $this->totalWin
        ];
    }
}