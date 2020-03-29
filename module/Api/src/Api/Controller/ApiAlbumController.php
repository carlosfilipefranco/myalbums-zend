<?php

namespace Api\Controller;

use Api\Controller\ApiController;
use Application\Form\AlbumForm;
use Application\Model\Album;
use Zend\Json\Json;

class ApiAlbumController extends ApiController
{

    public function indexAction()
    {
        $model = $this->getAlbumTable()->fetchAll();

        $this->sendOk("Lista de álbuns", $model->toArray());
    }

    public function addAction()
    {

        $request = $this->getRequest();
        if (!$request->isPost()) {
            $this->sendShortResponse(400, "Pedido inválido");
        }

        $data = Json::decode($request->getContent(), Json::TYPE_ARRAY);

        $form = new AlbumForm();
        $form->get('submit')->setValue('Add');
        $album = new Album();
        $form->setInputFilter($album->getInputFilter());
        $form->setData($data);

        if (!$form->isValid()) {
            $this->sendShortResponse(400, "Erros no formulário", $form->getMessages());
        }

        $album->exchangeArray($form->getData());
        $this->getAlbumTable()->saveAlbum($album);

        $this->sendOk("Álbum criado com sucesso!", null);
    }

    public function editAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            $this->sendShortResponse(400, "Pedido inválido");
        }

        $data = Json::decode($request->getContent(), Json::TYPE_ARRAY);
        $id = isset($data["id"]) ? $data["id"] : null;

        try {
            $model = $this->getAlbumTable()->getAlbum($id);
        } catch (\Exception $ex) {
            $this->sendShortResponse(404, "Álbum não encontrado");
        }

        $form  = new AlbumForm();
        $form->bind($model);
        $form->get('submit')->setAttribute('value', 'Edit');
        $form->setInputFilter($model->getInputFilter());
        $form->setData($data);

        if (!$form->isValid()) {
            $this->sendShortResponse(400, "Formulário inválido", $form->getMessages());
        }
        $this->getAlbumTable()->saveAlbum($model);


        $this->sendOk("Álbum editado com sucesso!", null);
    }

    public function viewAction()
    {
        $id = (int) $this->params()->fromQuery('id');

        if (!$id) {
            $this->sendShortResponse(400, "Pedido inválido");
        }

        try {
            $model = $this->getAlbumTable()->getAlbum($id);
        } catch (\Exception $ex) {
            $this->sendShortResponse(404, "Álbum não encontrado");
        }

        $this->sendOk("Álbum enviado com sucesso", $model);
    }

    public function deleteAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            $this->sendShortResponse(400, "Pedido inválido");
        }

        $data = Json::decode($request->getContent(), Json::TYPE_ARRAY);
        $id = isset($data["id"]) ? $data["id"] : null;

        if (!$id) {
            $this->sendShortResponse(400, "Pedido inválido");
        }

        try {
            $this->getAlbumTable()->deleteAlbum($id);
        } catch (\Exception $ex) {
            $this->sendShortResponse(404, "Álbum não encontrado");
        }

        $this->sendOk("Álbum apagado com sucesso!", null);
    }

    public function getAlbumTable()
    {
        if (!$this->albumTable) {
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Album\Model\AlbumTable');
        }
        return $this->albumTable;
    }
}
