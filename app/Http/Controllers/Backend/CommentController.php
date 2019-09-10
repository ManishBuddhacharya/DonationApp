<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Comment;
use App\CommentReply;

class CommentController extends Controller
{
    public function addComment(Request $request, $id)
    {
        $comment = new Comment;

        $comment->table = $request->table;
        $comment->table_id = $id;
        $comment->comment = $request->comment;
        $comment->user_id = auth()->user()->id;
        $comment->userc_id = auth()->user()->id;
        $comment->save();

    	return $comment;
    }

    public function replyComment(Request $request, $id)
    {
        $comment = new CommentReply;

        $comment->comment_id = $id;
        $comment->reply = $request->comment;
        $comment->userc_id = auth()->user()->id;
        $comment->save();
    	return $comment;
    }

    public function approveComment($id)
    {
        $comment = Comment::find($id);

        $comment->is_approve = 1;
		$comment->update();
    	return $comment;
    }

    public function disApproveComment($id)
    {
        $comment = Comment::find($id);

        $comment->is_approve = 0;
		$comment->update();
    	return $comment;
    }

    public function deleteComment($id)
    {
    	$comment = Comment::find($id)->delete();
    	if ($comment) {
	        return "Delete Successful";
    	}
    	else {
    		return "Something went wrong while deleting comment";
    	}
    }

    public function approveReply($id)
    {
        $comment = CommentReply::find($id);

        $comment->is_approve = 1;
		$comment->update();
    	return $comment;
    }

    public function disApproveReply($id)
    {
        $comment = CommentReply::find($id);

        $comment->is_approve = 0;
		$comment->update();
    	return $comment;
    }

    public function deleteReply($id)
    {
    	$comment = CommentReply::find($id)->delete();
    	if ($comment) {
	        return "Delete Successful";
    	}
    	else {
    		return "Something went wrong while deleting comment";
    	}
    }

    public function editComment(Comment $comment)
    {
        return $comment;
    }

    public function editReply(CommentReply $reply)
    {
        return $reply;
    }

    public function updateComment(Request $request, Comment $comment)
    {
        $comment->comment = $request->comment?:$comment->comment;
        $comment->update();

    	return $comment;
    }

    public function updateReply(Request $request, CommentReply $reply)
    {
        $reply->reply = $request->comment?:$reply->reply;
        $reply->update();

    	return $reply;
    }
}
