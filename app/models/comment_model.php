<?php

namespace Models;

// Deals with displaying, inserting and handling comments
class CommentModel{

	// Finds a comment that matches a particular linkid
	public static function find($linkid)
	{
		$db = \DB::get_instance();

		$stmt = $db->prepare("SELECT content FROM Comments WHERE linkid=?");	// TODO: Add support for user profiles and user specific data
		$stmt->execute([$linkid]);

		$rows = $stmt->fetchAll(); // fetchAll() does <$stmt = null;> automatically

		// Increment the click count
		\Models\LinkModel::setClickCount($linkid);

		return $rows;
	}

	// Insert the contents of a comment into the Comments table
	public static function insert($content, $linkid, $uid)
	{
		$db = \DB::get_instance();

		$stmt = $db->prepare("INSERT INTO Comments(content,linkid,`uid`)
								VALUES(?,?,?)");
		$stmt->execute([$content,$linkid,$uid]);
		$stmt = null;

		return;
	}
}