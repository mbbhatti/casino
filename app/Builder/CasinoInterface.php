<?php

namespace App\Builder;

interface CasinoInterface
{
    /**
     * Create random symbol board.
     *
     * @return void
     */
    public function createBoard(): void;
    
    /**
     * Get paylines.
     *
     * @return array
     */
    public function getPayLines(): array;

    /**
     * Get total paylines win.
     *
     * @param int  $number
     * @return void
     */
    public function calculateTotalWin(int $number): void;

    /**
     * Get payouts
     *
     * @return array
     */
    public function getPayout(): array;
}