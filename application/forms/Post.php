<?php
class Form_Post extends Zend_Form
{
    public function __construct($values = array())
    {
        parent::__construct();


        $this->setMethod('POST');
        $this->setAction('/admin/create');

        if ($values['id']) {
            $id = $this->createElement('hidden', 'post_id');
            $id->setValue($values['id']);
        }

        $title = $this->createElement('text', 'title');
        $title->setRequired(true)
              ->setLabel('Post Title: ')
              ->setValue($values['title']);

        $shortDescription = $this->createElement('text', 'short_description');
        $shortDescription->setRequired(true)
                         ->setLabel('Post Short Description')
                         ->setValue($values['short_description']);

        $body = $this->createElement('textarea', 'body');
        $body->setRequired(true)
             ->setLabel('Post Body: ')
             ->setValue($values['body']);

        $slug = $this->createElement('text', 'slug');
        $slug->setRequired(true)
             ->setLabel('URL (slug): ')
             ->setValue($values['slug']);

        $submit = $this->createElement('submit', 'submit');

        if ($id) {
            $this->addElement($id);
        }

        $this->addElement($title)
             ->addElement($shortDescription)
             ->addElement($body)
             ->addElement($slug)
             ->addElement($submit);
    }
}