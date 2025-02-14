<?php
/**
 * *************************************************************
 * Copyright (C) 2018,2020 Siemens AG
 * Author: Gaurav Mishra <mishra.gaurav@siemens.com>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * version 2 as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * *************************************************************
 */

/**
 * @file
 * @brief Helper for file related queries
 */
namespace Fossology\UI\Api\Helper;

use Fossology\Lib\Dao\PfileDao;
use Fossology\UI\Api\Models\Hash;

/**
 * @class FileHelper
 * @brief Handle file related queries
 */
class FileHelper
{
  /**
   * @var PfileDao $pfileDao
   * Pfile Dao object
   */
  private $pfileDao;

  /**
   * Constructor for FileHelper
   *
   * @param PfileDao $pfileDao
   */
  public function __construct(PfileDao $pfileDao)
  {
    $this->pfileDao = $pfileDao;
  }

  /**
   * Get the pfile info for given Hash
   *
   * @param Hash $hash Hash to get pfile info from
   * @return array|NULL
   * @sa Fossology::Lib::Dao::PfileDao::getPfile()
   */
  public function getPfile($hash)
  {
    return $this->pfileDao->getPfile($hash->getSha1(), $hash->getMd5(),
      $hash->getSha256(), $hash->getSize());
  }

  /**
   * Get the scanner findings for given pfile
   *
   * @param integer $pfileId PfileId to get licenses from
   * @return array List of licenses found
   * @sa Fossology::Lib::Dao::PfileDao::getScannerFindings()
   */
  public function pfileScannerFindings($pfileId)
  {
    return $this->pfileDao->getScannerFindings($pfileId);
  }

  /**
   * Get the conclusions for given pfile done by given group
   *
   * @param integer $groupId Group to filter conclusions from
   * @param integer $pfileId Pfile to get conclusions for
   * @return array List of licenses concluded
   * @sa Fossology::Lib::Dao::PfileDao::getConclusions()
   */
  public function pfileConclusions($groupId, $pfileId)
  {
    return $this->pfileDao->getConclusions($groupId, $pfileId);
  }

  /**
   * Get the uploads where the pfile was uploaded as package
   *
   * @param integer $pfileId Pfileid to search from
   * @return array|NULL Array of uploads or NULL if not found
   * @sa Fossology::Lib::Dao::PfileDao::getUploadForPackage()
   */
  public function getPackageUpload($pfileId)
  {
    return $this->pfileDao->getUploadForPackage($pfileId);
  }
}
