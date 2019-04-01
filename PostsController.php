<?php 
	class PostsController extends AppController {
	    public $helpers = array('Html', 'Form');
	    // hàm hiển thị khi truy cập trang chủ
	    public function index() {
	        $this->set('posts', $this->Post->find('all'));
	    }
	    // hàm hiển thị khi truy cập trang xem
	    public function view($id = null) {
	        if (!$id) {
	            throw new NotFoundException(__('Invalid post'));
	        }

	        $post = $this->Post->findById($id);
	        if (!$post) {
	            throw new NotFoundException(__('Invalid post'));
	        }
	        $this->set('post', $post);
	    }
	    // hàm hiển thị khi truy cập trang thêm
	    public function add() {
	        if ($this->request->is('post')) {
	            $this->Post->create();
	            if ($this->Post->save($this->request->data)) {
	                $this->Flash->success(__('Your post has been saved.'));
	                return $this->redirect(array('action' => 'index'));
	            }
	            $this->Flash->error(__('Unable to add your post.'));
	        }
	    }
	    // hàm hiển thị khi truy cập trang sửa
	    public function edit($id = null) {
		    if (!$id) {
		        throw new NotFoundException(__('Invalid post'));
		    }

		    $post = $this->Post->findById($id);
		    if (!$post) {
		        throw new NotFoundException(__('Invalid post'));
		    }

		    if ($this->request->is(array('post', 'put'))) {
		        $this->Post->id = $id;
		        if ($this->Post->save($this->request->data)) {
		            $this->Flash->success(__('Your post has been updated.'));
		            return $this->redirect(array('action' => 'index'));
		        }
		        $this->Flash->error(__('Unable to update your post.'));
		    }

		    if (!$this->request->data) {
		        $this->request->data = $post;
		    }
		}
		// hàm xóa bản ghi
		public function delete($id) {
		    if ($this->request->is('get')) {
		        throw new MethodNotAllowedException();
		    }

		    if ($this->Post->delete($id)) {
		        $this->Flash->success(
		            __('The post with id: %s has been deleted.', h($id))
		        );
		    } else {
		        $this->Flash->error(
		            __('The post with id: %s could not be deleted.', h($id))
		        );
		    }

		    return $this->redirect(array('action' => 'index'));
		}
	}
?>