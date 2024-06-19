<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Start Controller
 *
 */
class StartController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $start = "Hi James";

        $this->set(compact('start'));
    }
}
