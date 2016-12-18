<?php

namespace NickyWoolf\Carter\Shopify\Api;

class Article extends Resource
{
    public function all($blog, $query = false)
    {
        $request = $this->request->setPath("blogs/{$blog}/articles.json")->setQuery($query);

        $response = $this->client->get($request);

        return $this->parse($response, 'articles');
    }

    public function count($blog, $query = false)
    {
        $request = $this->request->setPath("blogs/{$blog}/articles/count.json")->setQuery($query);

        $response = $this->client->get($request);

        return $this->parse($response, 'count');
    }

    public function get($blog, $id, $query = false)
    {
        $request = $this->request->setPath("blogs/{$blog}/articles/{$id}.json")->setQuery($query);

        $response = $this->client->get($request);

        return $this->parse($response, 'article');
    }

    public function create($blog, array $article)
    {
        $request = $this->request->setPath("blogs/{$blog}/articles.json")->setJson(['article' => $article]);

        $response = $this->client->post($request);

        return $this->parse($response, 'article');
    }

    public function update($blog, $id, array $article)
    {
        $request = $this->request->setPath("blogs/{$blog}/articles/{$id}.json")->setJson(['article' => $article]);

        $response = $this->client->put($request);

        return $this->parse($response, 'article');
    }

    public function delete($blog, $id)
    {
        $request = $this->request->setPath("blogs/{$blog}/articles/{$id}.json");

        return $this->client->delete($request)->getStatusCode();
    }

    public function authors()
    {
        $request = $this->request->setPath('articles/authors.json');

        $response = $this->client->get($request);

        return $this->parse($response, 'authors');
    }

    public function tags($blog, $query = false)
    {
        $request = $this->request->setPath("blogs/{$blog}/articles/tags.json")->setQuery($query);

        $response = $this->client->get($request);

        return $this->parse($response, 'tags');
    }
}