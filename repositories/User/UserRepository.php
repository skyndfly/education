<?php
declare(strict_types=1);

namespace app\repositories\User;

use app\auth\dto\UserIdentityDto;
use DateMalformedStringException;
use DateTimeImmutable;
use app\repositories\BaseRepository;
use app\repositories\User\dto\UserInfoDto;
use app\repositories\User\dto\UserStoreDto;
use Yii;
use yii\db\Exception;

class UserRepository extends BaseRepository
{
    public const string TABLE_NAME = 'users';

    public function getById(int $id): ?UserIdentityDto
    {
        $result = $this->getQuery()
            ->from(self::TABLE_NAME)
            ->where(['id' => $id])
            ->one();
        if ($result === false) {
            return null;
        }
        return $this->mapToDto($result);
    }

    public function getByUsername(string $username): ?UserIdentityDto
    {
        $result = $this->getQuery()
            ->from(self::TABLE_NAME)
            ->where(['username' => $username])
            ->one();
        if ($result === false) {
            return null;
        }
        return $this->mapToDto($result);
    }

    /**
     * @throws DateMalformedStringException
     * @throws Exception
     */
    public function store(UserStoreDto $storeDto): ?UserIdentityDto
    {
        $this->getCommand()
            ->insert(
                self::TABLE_NAME,
                [
                    'username' => $storeDto->username,
                    'password_hash' => Yii::$app->security->generatePasswordHash($storeDto->password),
                    'first_name' => $storeDto->userInfo->firstName,
                    'name' => $storeDto->userInfo->name,
                    'last_name' => $storeDto->userInfo->lastName,
                    'birth_day' => (new DateTimeImmutable($storeDto->userInfo->birthDate))->format('Y-m-d'),
                    'number_phone' => $storeDto->userInfo->numberPhone,
                ]
            )
            ->execute();
        return $this->getById((int) Yii::$app->db->getLastInsertID());
    }


    /**
     * @param array{
     *     id: int,
     *     username: string,
     *     password_hash: string,
     *     created_at: string,
     *     updated_at: string,
     *     first_name: string,
     *     name: string,
     *     last_name: string,
     *     birth_day: string,
     *     number_phone: string,
     *     access_token: null|string,
     *     auth_key: null|string,
     * } $data
     * @return UserIdentityDto
     */
    private function mapToDto(array $data): UserIdentityDto
    {
        $userInfo = new UserInfoDto(
            firstName: $data['first_name'],
            name: $data['name'],
            lastName: $data['last_name'],
            birthDate: $data['birth_day'],
            numberPhone: $data['number_phone'],
        );
        return new UserIdentityDto(
            id: $data['id'],
            username: $data['username'],
            password: $data['password_hash'],
            createdAt: $data['created_at'],
            updatedAt: $data['updated_at'],
            userInfoDto: $userInfo,
            accessToken: $data['access_token'],
            authKey: $data['auth_key'],
        );
    }
}