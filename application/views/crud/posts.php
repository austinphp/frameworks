
<?php $this->load->view('crud/head'); ?>

<h3>Posts</h3>
<?php if ($this->posts){?>
    <table id="postslist">
    <tr>
        <th>Post Title</th>
        <th>Created At:</th>
        <th>Updated At:</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
    </tr>
    <?php foreach ($this->posts as $post){?>
    <tr>
        <td><?=$post->title?></td>
        <td><?=date("Y-m-d H:i:s", $post->created_at)?></td>
        <td><?=date("Y-m-d H:i:s", $post->updated_at)?></td>
        <td><a href="/admin/edit/id/<?=$post->id?>">Edit Post</a></td>
        <td><a href="/admin/delete/id/<?=$post->id?>">Delete Post</a></td>
    </tr>
    <?}?>
    </table>
<?}?>
<a href="/admin/create">Create new post</a>


        
<?php $this->load->view('crud/foot'); ?>        