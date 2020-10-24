<?php

namespace App\Models;

use App\Interfaces\BaseModelInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Contracts\Pagination\LengthAwarePaginator;
use \Illuminate\Database\Eloquent\Collection;

/**
 * @method static Builder where(mixed $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static LengthAwarePaginator paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
 * @method static Model|Builder create(array $attributes = [])
 * @method static Model|Collection|array|null find(mixed  $id, array  $columns = ['*'])
 */
class BaseModel extends Model implements BaseModelInterface
{
    use HasFactory;
}
