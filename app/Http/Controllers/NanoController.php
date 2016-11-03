<?php

namespace NanoCMS\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Auth;
use NanoCMS\Nvaccess;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class NanoController extends BaseController {

    use AuthorizesRequests,
        AuthorizesResources,
        DispatchesJobs,
        ValidatesRequests;

    public $usuario_logado;

    public function __construct() {
        if (Auth::check()) {
            $this->usuario_logado = Auth::user();
        }
    }

    /**
     * checkAcess
     * @param string $key Chave de acesso
     * @return boolean
     * @description Checa se o nivel de acesso do usuário logado é permitido para edição
     */
    public function checkAcess($key) {
        $this->acesso = Nvaccess::select('nivel')->where('key', '=', $key)->get()->toArray();

        if ($this->acesso) {
            foreach ($this->acesso as $acesso) {
                $acessIds[] = $acesso['nivel'];
            }

            if (in_array($this->usuario_logado->nivel, $acessIds)) {
                return true;
            } else {
                return redirect('erro/403')->send();
            }
        } else {
            return true;
        }
    }

}
