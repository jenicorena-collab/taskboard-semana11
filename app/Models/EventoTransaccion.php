namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventoTransaccion extends Model
{
    use HasFactory;

    protected $table = 'eventos_transaccion';

    protected $fillable = ['transaccion_id', 'tipo_evento', 'detalle'];

    public function transaccion()
    {
        return $this->belongsTo(Transaccion::class);
    }
}
