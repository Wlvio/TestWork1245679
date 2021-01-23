<?

namespace App\Http\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository
{
    public Builder $builder;

    public function __construct()
    {
        $this->builder = User::query();
    }

    public function findAll(): Collection
    {
        return $this->builder->get();
    }

    public function findById(int $id): User
    {
        
        $user = $this->builder->find($id);
        
        if (! $user instanceof User) {
            throw new ModelNotFoundException('Not found');
        }

        return $user;
    }
}
