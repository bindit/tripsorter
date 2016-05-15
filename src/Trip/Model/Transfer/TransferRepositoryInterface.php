<?php

namespace Trip\Model\Transfer;

/**
 * Interface TransferRepositoryInterface
 */
interface TransferRepositoryInterface
{
    /**
     * @param int $id
     * @return Transfer
     */
    public function find($id);
}
