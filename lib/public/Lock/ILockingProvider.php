<?php
/**
 * @author Morris Jobke <hey@morrisjobke.de>
 * @author Robin Appelman <icewind@owncloud.com>
 *
 * @copyright Copyright (c) 2018, ownCloud GmbH
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */

namespace OCP\Lock;

/**
 * Interface ILockingProvider
 *
 * @package OCP\Lock
 * @since 8.1.0
 */
interface ILockingProvider {
	/**
	 * @since 8.1.0
	 */
	public const LOCK_SHARED = 1;
	/**
	 * @since 8.1.0
	 */
	public const LOCK_EXCLUSIVE = 2;

	/**
	 * @since 10.0.10
	 */
	public const LOCK_SHARED_PERSISTENT = 3;

	/**
	 * @since 10.0.10
	 */
	public const LOCK_EXCLUSIVE_PERSISTENT = 4;

	/**
	 * @param string $path
	 * @param int $type self::LOCK_SHARED or self::LOCK_EXCLUSIVE
	 * @return bool
	 * @since 8.1.0
	 */
	public function isLocked($path, $type);

	/**
	 * @param string $path
	 * @param int $type self::LOCK_SHARED or self::LOCK_EXCLUSIVE or self::LOCK_*_PERSISTENT
	 * @param string $lockId - only relevant for self::LOCK_*_PERSISTENT
	 * @param \DateInterval $ttl - only relevant for self::LOCK_*_PERSISTENT
	 * @return
	 * @since 8.1.0
	 */
	public function acquireLock($path, $type, $lockId = null, $ttl = null);

	/**
	 * @param string $path
	 * @param int $type self::LOCK_SHARED or self::LOCK_EXCLUSIVE
	 * @param string $lockId - only relevant for self::LOCK_*_PERSISTENT
	 * @since 8.1.0
	 */
	public function releaseLock($path, $type, $lockId = null);

	/**
	 * Change the type of an existing lock
	 *
	 * @param string $path
	 * @param int $targetType self::LOCK_SHARED or self::LOCK_EXCLUSIVE
	 * @throws \OCP\Lock\LockedException
	 * @since 8.1.0
	 */
	public function changeLock($path, $targetType);

	/**
	 * release all lock of type self::LOCK_SHARED or self::LOCK_EXCLUSIVE
	 * acquired by this instance. Persistent locks are not released
	 * @since 8.1.0
	 */
	public function releaseAll();
}
