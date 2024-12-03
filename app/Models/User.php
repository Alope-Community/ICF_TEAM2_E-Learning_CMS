<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * @return Functions
     */
    public function setPassword($password)
	{
		$this->update([
			'password'	=> Hash::make($password)
		]);
		return $this;
	}
    public function comparePassword($password)
	{
		return Hash::check($password, $this->password);
	}

    public static function dataTable($request)
    {
        $data = self::select([ 'users.*' ]);

        return DataTables::eloquent($data)
            ->addColumn('action', function ($data) {
                $action = '
                	 <button type="button"
                data-delete-message="Yakin ingin menghapus <strong>' . $data->name . '</strong>?"
                data-delete-href="' . route('user.destroy', $data->id) . '"
                class="btn mb-2 icon-left btn-outline-danger btn-delete">
                <i class="ti-trash"></i> Hapus
            </button>
                ';
                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    // public function avatarPath()
	// {
	// 	return storage_path('app/public/avatars/'.$this->avatar);
	// }

	// public function avatarLink()
	// {
	// 	if($this->isHasAvatar()) {
	// 		return url('storage/avatars/'.$this->avatar);
	// 	}

	// 	return url('img/default-avatar.jpg');
	// }

    // public function setAvatar($request)
	// {
	// 	if(!empty($request->upload_avatar)) {
	// 		$this->removeAvatar();
	// 		$file = $request->file('upload_avatar');
	// 		$filename = date('YmdHis_').$file->getClientOriginalName();
	// 		$file->move(storage_path('app/public/avatars'), $filename);
	// 		$this->update([
	// 			'avatar' => $filename,
	// 		]);
	// 	}

	// 	return $this;
	// }

    /**
     * @return For Crud User
     */
    public static function createUser($request){
        $user = self::create($request);
        $user->setPassword($request['password']);
        return $user;
    }

    public function updateUser($request){
        $this->update($request->except('password'));
        $this->setPassword($request->password);
        return $this;
    }
    /**
     * @return Relathionship
     */
}
