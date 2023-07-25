<?php

    class MovieList{

        // attributes
        private $list_id = 0;
        private $user_id = 0;
        private $list_name = "";
        private $list_description = "";
        private $created_at = "";

        // getters
        function getListId() : int {
            return $this->list_id;
        }
        function getUserId(): int{
            return $this->user_id;
        }
        function getListName(): string {
            return $this->list_name;
        }
        function getListDescription(): string {
            return $this->list_description;
        }
        function getCreatedAt(): string {
            return $this->created_at;
        }

        // setters
        function setUserId($user_id) {
            $this->user_id = $user_id;
        }
        function setListName ($listName) {
            $this->list_name = $listName;
        }
        function setListDescription ($listDescription) {
            $this->list_description = $listDescription;
        }
        function setCreatedAt ($createdAt) {
            $this->created_at = $createdAt;
        }
    }

?>