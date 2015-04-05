<?php
class BookSeeder extends Seeder {
    public function run()
    {

        DB::table('books')->delete();

        $book = new Book;
        $book->title = "Business Process";
        $book->author = "Michael Joshua A. Pena";
        $book->quantity = 5;
        $book->category_categoryID = 1;
        $book->save();

        $book = new Book;
        $book->title = "Pugad Baboy IX";
        $book->author = "Pol Medina Jr.";
        $book->quantity = 3;
        $book->category_categoryID = 2;
        $book->save();

        $category = new Category;
        $category->categoryName = "Business";
        $category->save();

        $category = new Category;
        $category->categoryName = "Comics";
        $category->save();



    }
}