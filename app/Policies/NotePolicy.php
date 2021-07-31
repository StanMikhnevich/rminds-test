<?php

namespace App\Policies;

use App\Http\Requests\BaseFormRequest;
use App\Models\Note;
use App\Models\NoteShared;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
//        return (bool) $user;
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User|null $user
     * @param \App\Models\Note $note
     * @return bool
     */
    public function view(?User $user, Note $note): bool
    {
        $isOwner = $user && $note->user_id == ($user->id ?? '');
        $hasAccess = $note->shared_users()->find(($user->id ?? ''));
        $canRead = (!$note->private && !$user);

        return ($isOwner || $hasAccess || $canRead);
    }
//        return ($request->isAuthenticated()) ? ($isOwner || $hasAccess) : false;

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function store(User $user): bool
    {
        return (bool)$user;
    }

    /**
     * Determine whether the user can edit the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Note $note
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function edit(User $user, Note $note): bool
    {
        return (bool)$note->user_id == $user->id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Note $note
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Note $note): bool
    {
        return (bool)$note->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Note $note
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Note $note): bool
    {
        return (bool)$note->user_id == $user->id;
    }

    /**
     * Determine whether the user can share the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Note $note
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function share(User $user, Note $note): bool
    {
        return (bool)$note->user_id == $user->id;
    }

    /**
     * Determine whether the user can unshare the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Note $note
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function unshare(User $user, Note $note): bool
    {
        return (bool)$note->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete attachments of the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Note $note
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function detach(User $user, Note $note): bool
    {
        return (bool) $note->user_id == $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Note $note
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Note $note): bool
    {
        return (bool)$note->user_id == $user->id;
    }
}
