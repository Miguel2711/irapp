<?php

namespace App\Http\Controllers\Clasificacion\Categoria;
use App\Http\Controllers\Controller;
use App\Models\Clasificacion\Categoria;
use SweetAlert;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaSoftDeleteController extends Controller
{
    protected $redirectTo = '/login';
    
    public function __construct()
    {
     $this->middleware('auth');
    }

    /**
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    private static function getDeletedCategoria($id)
    {
        $categoria = Categoria::onlyTrashed()->where('id', $id)->get();
        
        if (count($categoria) != 1) {
            SweetAlert::error('Error','La categoria no existe.');
            return redirect('/categorias/deleted');
        }

        return $categoria[0];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->authorizeRoles(['ROLE_ROOT','ROLE_ADMINISTRADOR'],TRUE);
        $categorias = Categoria::onlyTrashed()->get();
        return View('clasificacion.categorias.index_deleted', compact('categorias'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        Auth::user()->authorizeRoles(['ROLE_ROOT','ROLE_ADMINISTRADOR'],TRUE);
        $categoria = self::getDeletedCategoria($id);
        $categoria->restore();
        SweetAlert::success('Exito','La categoria "'.$categoria->nombre.'" ha sido restaurada.');
        return Redirect::to('categorias/deleted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Auth::user()->authorizeRoles(['ROLE_ROOT','ROLE_ADMINISTRADOR'],TRUE);
        $categoria = self::getDeletedCategoria($id);
        $categoria->forceDelete();
        SweetAlert::success('Exito','La categoria "'.$categoria->nombre.'" ha sido eliminada permanentemente.');
        return Redirect::to('categorias/deleted');
    }
}
