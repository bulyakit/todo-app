<?php

namespace App\Apps\ToDo\Presentation\Formatter;

use App\Apps\ToDo\Application\Collection\ToDoCollection;
use App\Apps\ToDo\Domain\Aggregate\ToDo;
use Exception;
use App\Formatter\Group;
use App\Formatter\GroupCollection;
use App\Formatter\Password;
use App\Formatter\Role;
use App\Formatter\RoleCollection;
use App\Formatter\Token;
use App\Formatter\TokenHash;
use App\Formatter\UnsignedInteger;
use App\Formatter\User;
use App\Formatter\UserLog;
use App\Formatter\UserLogCollection;


/**
 * Class ToDoResponseFormatter
 */
class ToDoResponseFormatter
{
    /**
     * @param UnsignedInteger $userId
     *
     * @return array
     */
    public function formatAdd(UnsignedInteger $userId): array
    {
        return [
            'userId' => $userId->getValue(),
        ];
    }

    /**
     * @param Password $password
     *
     * @return array
     */
    public function formatResetPassword(Password $password): array
    {
        return [
            'password' => $password->getValue(),
        ];
    }

    /**
     * @param ToDo $toDo
     *
     * @return array
     *
     * @throws Exception
     */
    public function formatGet(ToDo $toDo): array
    {
        return [
            'service' => $toDo->getService(),
        ];
    }

    /**
     * @param ToDoCollection $toDos
     *
     * @return array
     *
     * @throws Exception
     */
    public function formatGetAll(ToDoCollection $toDos): array
    {
        $response = [];

        foreach ($toDos as $toDo) {
            $response['todo'][] = $this->formatGet($toDo);
        }

        return $response;
    }

    /**
     * @param User $user
     * @param TokenHash $token
     * @param RoleCollection $roles
     *
     * @return array
     *
     * @throws Exception
     */
    public function formatLogin(User $user, TokenHash $token, RoleCollection $roles): array
    {
        $formattedRoles = [];
        /** @var Role $role */
        foreach ($roles as $role) {
            $formattedRoles[] = $role->getUri()->getValue();
        }

        return [
            'userId'              => $user->getId()->getValue(),
            'employeeId'          => $user->getEmployeeId()->getValue(),
            'token'               => $token->getValue(),
            'isGeneratedPassword' => $user->isGeneratedPassword()->getValue() ? 'y' : 'n',
            'avatar'              => $user->getAvatar() ? $user->getAvatar()->getUri() : '',
            'acceptedAt'          => $user->getAcceptedAt() ? $user->getAcceptedAt()->getIsoDate() : '',
            'roles'               => $formattedRoles,
        ];
    }

    /**
     * @param UnsignedInteger $groupId
     *
     * @return array
     */
    public function formatAddGroup(UnsignedInteger $groupId): array
    {
        return [
            'groupId' => $groupId->getValue(),
        ];
    }

    /**
     * @param Group $group
     *
     * @return array
     */
    public function formatGetGroup(Group $group): array
    {
        return [
            'id'     => $group->getId()->getValue(),
            'name'   => $group->getName()->getValue(),
            'status' => $group->getStatus()->getValue(),
        ];
    }

    /**
     * @param GroupCollection $groups
     *
     * @return array
     */
    public function formatGetAllGroup(GroupCollection $groups): array
    {
        $response = [];

        foreach ($groups as $group) {
            $response['groups'][] = $this->formatGetGroup($group);
        }

        return $response;
    }

    /**
     * @param GroupCollection $groups
     *
     * @return array
     */
    public function formatGetUserGroups(GroupCollection $groups): array
    {
        return $this->formatGetAllGroup($groups);
    }

    /**
     * @param UnsignedInteger $roleId
     *
     * @return array
     */
    public function formatAddRole(UnsignedInteger $roleId): array
    {
        return [
            'roleId' => $roleId->getValue(),
        ];
    }

    /**
     * @param Role $role
     *
     * @return array
     */
    public function formatGetRole(Role $role): array
    {
        return [
            'id'     => $role->getId()->getValue(),
            'name'   => $role->getName()->getValue(),
            'uri'    => $role->getUri()->getValue(),
            'status' => $role->getStatus()->getValue(),
        ];
    }

    /**
     * @param RoleCollection $roles
     *
     * @return array
     */
    public function formatGetAllRole(RoleCollection $roles): array
    {
        $response = [];

        foreach ($roles as $role) {
            $response['roles'][] = $this->formatGetRole($role);
        }

        return $response;
    }

    /**
     * @param RoleCollection $roles
     *
     * @return array
     */
    public function formatGetUserRoles(RoleCollection $roles): array
    {
        return $this->formatGetAllRole($roles);
    }

    /**
     * @param RoleCollection $roles
     *
     * @return array
     */
    public function formatGetGroupRoles(RoleCollection $roles): array
    {
        return $this->formatGetAllRole($roles);
    }

    /**
     * @param Token $token
     *
     * @return array
     *
     * @throws Exception
     */
    public function formatGetToken(Token $token)
    {
        return [
            'token'      => $token->getTokenHash()->getValue(),
            'userId'     => $token->getUserId()->getValue(),
            'expiryDate' => $token->getExpiryDate()->getIsoDate(),
            'createdAt'  => $token->getCreatedAt()->getIsoDate(),
            'createdBy'  => $token->getCreatedBy()->getValue(),
        ];
    }

    /**
     * @param UnsignedInteger $logId
     *
     * @return array
     */
    public function formatAddLog(UnsignedInteger $logId): array
    {
        return [
            'logId' => $logId->getValue(),
        ];
    }

    /**
     * @param UserLog $log
     *
     * @return array
     *
     * @throws Exception
     */
    public function formatGetLog(UserLog $log): array
    {
        return [
            'id'        => $log->getId()->getValue(),
            'userId'    => $log->getUserId()->getValue(),
            'message'   => $log->getMessage()->getValue(),
            'createdAt' => $log->getCreatedAt()->getIsoDate(),
            'createdBy' => $log->getCreatedBy()->getValue(),
        ];
    }

    /**
     * @param UserLogCollection $logs
     *
     * @return array
     *
     * @throws Exception
     */
    public function formatGetAllLog(UserLogCollection $logs): array
    {
        $response = [];

        foreach ($logs as $log) {
            $response['logs'][] = $this->formatGetLog($log);
        }

        return $response;
    }

    /**
     * @param UnsignedInteger $tokenId
     *
     * @return array
     */
    public function formatAddNotificationToken(UnsignedInteger $tokenId): array
    {
        return [
            'tokenId' => $tokenId->getValue(),
        ];
    }

    /**
     * @param UnsignedInteger $notificationId
     *
     * @return array
     */
    public function formatAddNotificationMessage(UnsignedInteger $notificationId): array
    {
        return [
            'notificationId' => $notificationId->getValue(),
        ];
    }

    /**
     * @param UnsignedInteger $forgottenPasswordHashId
     *
     * @return array
     */
    public function formatAddForgottenPasswordHash(UnsignedInteger $forgottenPasswordHashId): array
    {
        return [
            'forgottenPasswordHashId' => $forgottenPasswordHashId->getValue(),
        ];
    }
}
