<?php

namespace codeheadco\tools;

/**
 *
 * @author Varga Gábor <gabor87@outlook.com>
 */
interface DirectoryInterface {
    
    /**
     * @return DirectoryPath Description
     */
    public function getDirectoryPath($create = true);
    
}
