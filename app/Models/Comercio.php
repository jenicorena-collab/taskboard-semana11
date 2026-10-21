namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comercio extends Model
{
    use HasFactory;
    protected $fillable = ['nombre_comercio'];

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class);
    }
}
