<?php

namespace NanoCMS\Http\Controllers\NanoCMS;

// Use - Defaults
use Illuminate\Http\Request;
use NanoCMS\Http\Requests;
use NanoCMS\Http\Requests\CMSUserRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
// Use - Custom
use NanoCMS\CMSConfig;
use NanoCMS\Nivel;
use NanoCMS\Nvaccess;

class CMSConfigsController extends \NanoCMS\Http\Controllers\NanoController {

    public function __construct(Request $request) {
        parent::__construct();
        parent::checkAcess('accessConfigs');

        $this->middleware('auth');
        $this->retorno = array();
        $this->request = $request->except('_token');
        if(!empty($this->request))
            $this->retorno['request'] = $this->request;

        $this->area = 'nano.cms.configs';

        if (Session::has('mensagem')) {
            $this->retorno['mensagem'] = Session::get('mensagem');
            Session::pull('mensagem');
        }
    }

    /**
     *   Listagem das configurações
     */
    public function index() {
        return view($this->area . ".index", $this->retorno);
    }

    /**
     * 	Edição de configurações
     */
    public function edit() {
        $configs = CMSConfig::all()->toArray();
        foreach ($configs as $configKey => $configVal) {
            $returnCfg[$configVal['chave']] = $configVal['valor'];
        }

        $nivelAcesso = array();
        
        $accessUsersArray = Nvaccess::where('key', '=', 'accessUsers')->get()->toArray();
        if($accessUsersArray){
            foreach ($accessUsersArray as $accessUsers) {
                $accessUsersIds[] = $accessUsers['nivel'];
            }
            $nivelAcesso['accessUsers'] = $accessUsersIds;
        }

        $accessPagesArray = Nvaccess::where('key', '=', 'accessPages')->get()->toArray();
        if($accessPagesArray){
            foreach ($accessPagesArray as $accessPages) {
                $accessPagesIds[] = $accessPages['nivel'];
            }
            $nivelAcesso['accessPages'] = $accessPagesIds;
        }

        $accessMenusArray = Nvaccess::where('key', '=', 'accessMenus')->get()->toArray();
        if($accessMenusArray){
            foreach ($accessMenusArray as $accessMenus) {
                $accessMenusIds[] = $accessMenus['nivel'];
            }
            $nivelAcesso['accessMenus'] = $accessMenusIds;
        }

        $accessFormsArray = Nvaccess::where('key', '=', 'accessForms')->get()->toArray();
        if($accessFormsArray){
            foreach ($accessFormsArray as $accessForms) {
                $accessFormsIds[] = $accessForms['nivel'];
            }
            $nivelAcesso['accessForms'] = $accessFormsIds;
        }

        $accessBannersArray = Nvaccess::where('key', '=', 'accessBanners')->get()->toArray();
        if($accessBannersArray){
            foreach ($accessBannersArray as $accessBanners) {
                $accessBannersIds[] = $accessBanners['nivel'];
            }
            $nivelAcesso['accessBanners'] = $accessBannersIds;
        }

        $accessAgendaArray = Nvaccess::where('key', '=', 'accessAgenda')->get()->toArray();
        if($accessAgendaArray){
            foreach ($accessAgendaArray as $accessAgenda) {
                $accessAgendaIds[] = $accessAgenda['nivel'];
            }
            $nivelAcesso['accessAgenda'] = $accessAgendaIds;
        }

        $accessCategoriasArray = Nvaccess::where('key', '=', 'accessCategorias')->get()->toArray();
        if($accessCategoriasArray){
            foreach ($accessCategoriasArray as $accessCategorias) {
                $accessCategoriasIds[] = $accessCategorias['nivel'];
            }
            $nivelAcesso['accessCategorias'] = $accessCategoriasIds;
        }

        $accessBlocosArray = Nvaccess::where('key', '=', 'accessBlocos')->get()->toArray();
        if($accessBlocosArray){
            foreach ($accessBlocosArray as $accessBlocos) {
                $accessBlocosIds[] = $accessBlocos['nivel'];
            }
            $nivelAcesso['accessBlocos'] = $accessBlocosIds;
        }

        $accessPostsArray = Nvaccess::where('key', '=', 'accessPosts')->get()->toArray();
        if($accessPostsArray){
            foreach ($accessPostsArray as $accessPosts) {
                $accessPostsIds[] = $accessPosts['nivel'];
            }
            $nivelAcesso['accessPosts'] = $accessPostsIds;
        }

        $accessSEOArray = Nvaccess::where('key', '=', 'accessSEO')->get()->toArray();
        if($accessSEOArray){
            foreach ($accessSEOArray as $accessSEO) {
                $accessSEOIds[] = $accessSEO['nivel'];
            }
            $nivelAcesso['accessSEO'] = $accessSEOIds;
        }

        $accessGaleriasArray = Nvaccess::where('key', '=', 'accessGalerias')->get()->toArray();
        if($accessGaleriasArray){
            foreach ($accessGaleriasArray as $accessGalerias) {
                $accessGaleriasIds[] = $accessGalerias['nivel'];
            }
            $nivelAcesso['accessGalerias'] = $accessGaleriasIds;
        }

        $accessConfigsArray = Nvaccess::where('key', '=', 'accessConfigs')->get()->toArray();
        if($accessConfigsArray){
            foreach ($accessConfigsArray as $accessConfigs) {
                $accessConfigsIds[] = $accessConfigs['nivel'];
            }
            $nivelAcesso['accessConfigs'] = $accessConfigsIds;
        }


        $this->retorno['configs'] = $returnCfg;
        $this->retorno['niveis'] = Nivel::all();
        $this->retorno['acessos'] = $nivelAcesso;
        return view($this->area . '.editar', $this->retorno);
    }

    /**
     * 	Editar configurações no banco
     */
    public function update() {
        $msg = array();

        $delAcessConfigs = Nvaccess::where('key', '=', 'accessUsers')->delete();
        if(isset($this->request['accessUsers'])){
            foreach($this->request['accessUsers'] as $acessUsersId){
                $setAcessUsers = new Nvaccess;
                $setAcessUsers->key = 'accessUsers';
                $setAcessUsers->nivel = $acessUsersId;
                $setAcessUsers->save();
            }
            unset($this->request['accessUsers']);
        }

        $delAcessPages = Nvaccess::where('key', '=', 'accessPages')->delete();
        if(isset($this->request['accessPages'])){
            foreach($this->request['accessPages'] as $acessPagesId){
                $setAcessPages = new Nvaccess;
                $setAcessPages->key = 'accessPages';
                $setAcessPages->nivel = $acessPagesId;
                $setAcessPages->save();
            }
            unset($this->request['accessPages']);
        }

        $delAcessMenus = Nvaccess::where('key', '=', 'accessMenus')->delete();
        if(isset($this->request['accessMenus'])){
            foreach($this->request['accessMenus'] as $acessMenusId){
                $setAcessMenus = new Nvaccess;
                $setAcessMenus->key = 'accessMenus';
                $setAcessMenus->nivel = $acessMenusId;
                $setAcessMenus->save();
            }
            unset($this->request['accessMenus']);
        }

        $delAcessForms = Nvaccess::where('key', '=', 'accessForms')->delete();
        if(isset($this->request['accessForms'])){
            foreach($this->request['accessForms'] as $acessFormsId){
                $setAcessForms = new Nvaccess;
                $setAcessForms->key = 'accessForms';
                $setAcessForms->nivel = $acessFormsId;
                $setAcessForms->save();
            }
            unset($this->request['accessForms']);
        }

        $delAcessBanners = Nvaccess::where('key', '=', 'accessBanners')->delete();
        if(isset($this->request['accessBanners'])){
            foreach($this->request['accessBanners'] as $acessBannersId){
                $setAcessBanners = new Nvaccess;
                $setAcessBanners->key = 'accessBanners';
                $setAcessBanners->nivel = $acessBannersId;
                $setAcessBanners->save();
            }
            unset($this->request['accessBanners']);
        }

        $delAcessAgenda = Nvaccess::where('key', '=', 'accessAgenda')->delete();
        if(isset($this->request['accessAgenda'])){
            foreach($this->request['accessAgenda'] as $acessAgendaId){
                $setAcessAgenda = new Nvaccess;
                $setAcessAgenda->key = 'accessAgenda';
                $setAcessAgenda->nivel = $acessAgendaId;
                $setAcessAgenda->save();
            }
            unset($this->request['accessAgenda']);
        }

        $delAcessCategorias = Nvaccess::where('key', '=', 'accessCategorias')->delete();
        if(isset($this->request['accessCategorias'])){
            foreach($this->request['accessCategorias'] as $acessCategoriasId){
                $setAcessCategorias = new Nvaccess;
                $setAcessCategorias->key = 'accessCategorias';
                $setAcessCategorias->nivel = $acessCategoriasId;
                $setAcessCategorias->save();
            }
            unset($this->request['accessCategorias']);
        }

        $delAcessBlocos = Nvaccess::where('key', '=', 'accessBlocos')->delete();
        if(isset($this->request['accessBlocos'])){
            foreach($this->request['accessBlocos'] as $acessBlocosId){
                $setAcessBlocos = new Nvaccess;
                $setAcessBlocos->key = 'accessBlocos';
                $setAcessBlocos->nivel = $acessBlocosId;
                $setAcessBlocos->save();
            }
            unset($this->request['accessBlocos']);
        }

        $delAcessPosts = Nvaccess::where('key', '=', 'accessPosts')->delete();
        if(isset($this->request['accessPosts'])){
            foreach($this->request['accessPosts'] as $acessPostsId){
                $setAcessPosts = new Nvaccess;
                $setAcessPosts->key = 'accessPosts';
                $setAcessPosts->nivel = $acessPostsId;
                $setAcessPosts->save();
            }
            unset($this->request['accessPosts']);
        }

        $delAcessSEO = Nvaccess::where('key', '=', 'accessSEO')->delete();
        if(isset($this->request['accessSEO'])){
            foreach($this->request['accessSEO'] as $acessSEOId){
                $setAcessSEO = new Nvaccess;
                $setAcessSEO->key = 'accessSEO';
                $setAcessSEO->nivel = $acessSEOId;
                $setAcessSEO->save();
            }
            unset($this->request['accessSEO']);
        }

        $delAcessGalerias = Nvaccess::where('key', '=', 'accessGalerias')->delete();
        if(isset($this->request['accessGalerias'])){
            foreach($this->request['accessGalerias'] as $acessGaleriasId){
                $setAcessGalerias = new Nvaccess;
                $setAcessGalerias->key = 'accessGalerias';
                $setAcessGalerias->nivel = $acessGaleriasId;
                $setAcessGalerias->save();
            }
            unset($this->request['accessGalerias']);
        }

        $delAcessConfigs = Nvaccess::where('key', '=', 'accessConfigs')->delete();
        if(isset($this->request['accessConfigs'])){
            foreach($this->request['accessConfigs'] as $acessConfigsId){
                $setAcessConfigs = new Nvaccess;
                $setAcessConfigs->key = 'accessConfigs';
                $setAcessConfigs->nivel = $acessConfigsId;
                $setAcessConfigs->save();
            }
            unset($this->request['accessConfigs']);
        }

        foreach ($this->request as $key => $value) {
            $getUpdate = CMSConfig::where('chave', '=', $key)->get()->first();
            if($getUpdate){
                $getUpdate->valor = $value;
                $getUpdate->save();
                unset($getUpdate);
            }else{
                $msg[$key] = 'Erro ao editar o campo ';
            }
        }

        if (count($msg) == 0) {
            Session::put('mensagem', [
                'class' => 'alert-success',
                'text' => 'Configurações efetuadas com sucesso!'
            ]);
        }else{
            Session::put('mensagem', [
                'class' => 'alert-success',
                'text' => 'Configurações não efetuadas corretamente. Por favor tente novamente.'
            ]);
        }
        return redirect()->route($this->area . '.index')->with($this->retorno);
    }

}
