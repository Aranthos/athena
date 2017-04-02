<?php namespace Zeropingheroes\Lanager\Domain\Users;

use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract {

	/**
	 * Transform resource into standard output format with correct typing
	 * @param  object BaseModel   Resource being transformed
	 * @return array              Transformed object array ready for output
	 */
	public function transform(User $user)
	{
		return [
			'id'			=> (int) $user->id,
			'visible'		=> $user->visible,
			'username'		=> $user->username,
			'steam_id_64'	=> $user->steam_id_64,
			'ip'			=> $user->ip,
			'avatar'		=> $user->avatar,
			'avatar_small'	=> $user->present()->avatarSmall(),
			'avatar_medium'	=> $user->present()->avatarMedium(),
			'avatar_large'	=> $user->present()->avatarLarge(),
			'links'			=> [
				[
					'rel' => 'self',
					'uri' => (url().'/users/'. $user->id),
				]
			],
		];
	}
}
