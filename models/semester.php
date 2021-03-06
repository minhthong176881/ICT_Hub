<?php
class Semester {
    public $semester;

    function __construct()
    {
        $this->semester = DB::getInstance()->selectCollection('semesters');
    }

    function all() {
        $list = [];
        $req = $this->semester->find();
        foreach ($req as $item) {
            array_push($list, $item);
        }
        return $list;
    }

    public function getById($id) { 
        $req = $this->semester->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);
        return $req;
    }

    public function getBySubjectId($id) {
        $list = $this->all();
        $selectedSemester = null;
        foreach ($list as $item) {
            foreach($item->subjects as $subject) {
                if ($subject->_id == $id) $selectedSemester = $item;
            }
        }
        return $selectedSemester;
    }
    public function deleteSubject($subjectId) {
        $semId = $this->getBySubjectId($subjectId)->_id;
        $this->semester->updateOne(
            [ "_id" => $semId ],
            [ '$pull' => [ "subjects" => [ "_id" => new MongoDB\BSON\ObjectID($subjectId) ] ] ]
          );
    }

    public function search($query) {
        $semesters = $this->all();
        $list = [];
        foreach ($semesters as $semester) {
            if (str_contains(strtolower($semester->name), $query)) array_push($list, $semester);
        }
        return $list;
    }
    public function addSubjectToSemester($semesterId, $subject) {
        $req = $this->semester->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($semesterId)],
            ['$push' => ["subjects" => $subject]]
        );
        return $req;
    }
}