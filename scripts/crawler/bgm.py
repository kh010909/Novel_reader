from translate import Translator
# from transformers import pipeline
# import torch
import requests

API_URL = "https://api-inference.huggingface.co/models/facebook/bart-large-mnli"
headers = {"Authorization": f"Bearer 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"}

def oracle(payload):
    response = requests.post(API_URL, headers=headers, json=payload)
    return response.json()
# oracle = pipeline(model="facebook/bart-large-mnli")
def analyze_novel_type(text):
  Novel={
      "Science_Novel" : 1,
      'Romantic_Novel' : 2,
      'Magic_Novel' : 3,
      'Detective_Novel' : 4,
      'Other_Novel' : 5,
  }
  result = 0
  result =oracle({
    "inputs": text,
    "parameters": {"candidate_labels": ["Science_Novel", "Romantic_Novel", "Magic_Novel", "Detective_Novel", "Other_Novel"]},
  })
  return Novel[result['labels'][0]]

def analyze_emotion(text):
  Emotion={
      "joy":1,
      "love":2,
      "sadness":3,
      "fear":4,
      "anger":5
  }
  result = 0
  result =oracle({
    "inputs": text,
    "parameters": {"candidate_labels": ["joy", "love", "sadness", "fear","anger"]},
  })
  return Emotion[result['labels'][0]]

def add_music(text):
  #尚算準 但久 ， 可能之後使用其他模型 或 chatgpt  或讓他在網頁選擇
  whole_music_type = []
  whole_music_emotion = []
  n = 1200 # chunk length
  text_list = [text[i:i+n] for i in range(0, len(text), n)]
  output = ""
  num = 0
  for text in text_list:
    #將文章分段(每1200字)並存在一個list 中(原文本) 每段文章跑分析output(處理好的文本(先做去tag)，music 維度)， 總結
    #可能每遇到br 就算一次 或預先處理掉br -> 都在另外一個function 做 包含分段
    text_ori = text
    text = Translator(from_lang="zh",to_lang="en").translate(text)
    novel_type = analyze_novel_type(text)
    emotion = analyze_emotion(text)
    #add music tag to the start of the article, or return music data(let the function outside do this work)
    div = '<div id="music-{}" class="mtype-{} memo-{}">'.format(num,novel_type, emotion)
    text = div + text_ori + "</div>"
    whole_music_type.append(novel_type)
    whole_music_emotion.append(emotion)
    output = output + text
    num = num+1

  counter_type = 0
  max_type = whole_music_type[0]
  for i in whole_music_type:
    curr_frequency = whole_music_type.count(i)
    if(curr_frequency> counter_type):
      counter_type = curr_frequency
      page_type = i

  counter_emotion = 0
  max_type = whole_music_emotion[0]
  for i in whole_music_emotion:
    curr_frequency = whole_music_emotion.count(i)
    if(curr_frequency> counter_emotion):
      counter_emotion = curr_frequency
      page_emo = i
 
  div = '<div id="music-{}" class="mtype-{} memo-{}">'.format("whole",page_type, page_emo)
  output = div + output + "</div>"
  
  
  return output