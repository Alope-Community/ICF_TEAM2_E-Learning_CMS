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
                	 <div class="dropdown">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            pilih Aksi
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><button class="dropdown-item btn-delete"" data-delete-href="'. route('user.destroy', $data->id) . '">Hapus</button></li>
                        </ul>
                    </div>
                ';
                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


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
