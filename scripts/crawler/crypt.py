#目前是未用到的檔案，用來加密檔案
import requests #session
import os
import io #用于在内存中操作二进制数据
import sys
import pyAesCrypt #加解密
import bs4 #轉義文件

#本地py
import crawler


def crawlerCryptToLocal(pageURL, wb_name, dir):
    # insert novel
    #wb_name include: 小說狂人(czbooks)、起點中文網(qidian)、晉江文學城(jjwxc)
    if (wb_name == "czbooks"):
        nName, author, description, completed, tags, nImg_link, nextLink = crawler.get_czbooks_novel(
            pageURL)
    elif (wb_name == "qidian"):
        nName, author, description, completed, tags, nImg_link, nextLink = crawler.get_qidian_novel(
            pageURL)
    elif (wb_name == "jjwxc"):
        nName, author, description, completed, tags, nImg_link, nextLink = crawler.get_jjwxc_novel(
            pageURL)
    html_content="<html><body>"
    html_content+="<p id='nName'>{}</p><p id='author'>{}</p><p id='completed'>{}</p><p id='description'>{}</p>".format(nName, author, completed, description)
    html_content+="<p id='tags'>{}</p>".format(",".join(tags))
    pageURL = nextLink
    # insert article
    if(wb_name == "czbooks"):
        aChapter = 0
        html_content+="<div id='articles'>"
        while nextLink != "":
            aName, aContent, nextLink = crawler.get_czbooks_article(pageURL)

            html_content+="<div id='aChapter-{}'><p id='aName'>{}</p><p id='aContent'>{}</p></div>".format(aChapter, aName, aContent)
            # 防止TypeError: can only concatenate str (not "NoneType") to str
            if nextLink is None:
                nextLink = ""
            pageURL = nextLink
            aChapter += 1
        html_content+="</div></body></html>"
    elif(wb_name=="qidian"):
        aChapter = 1
        while nextLink != "":
            aName, aContent, nextLink = crawler.get_qidian_article(pageURL)

            html_content+="<div id='aChapter-{}'><p id='articleName'>{}</p><p id='articleContent'>{}</p></div>".format(aChapter, aName, aContent)
            # 防止TypeError: can only concatenate str (not "NoneType") to str
            if nextLink is None:
                nextLink = ""
            pageURL = nextLink
            aChapter += 1
        html_content+="</body></html>"
    elif(wb_name=="jjwxc"): 
        aChapter = 1
        while nextLink != "":
            aName, aContent, nextLink = crawler.get_jjwxc_article(pageURL)

            html_content+="<div id='aChapter-{}'><p id='articleName'>{}</p><p id='articleContent'>{}</p></div>".format(aChapter, aName, aContent)
            # 防止TypeError: can only concatenate str (not "NoneType") to str
            if nextLink is None:
                nextLink = ""
            pageURL = nextLink
            aChapter += 1
        html_content+="</body></html>"
    
    #Store to local
    file_name=repr(nName).replace("/", "_")+".html"
    file_path = os.path.abspath(os.path.join(dir, file_name))

    # os.chdir(sys.path[0])
    if not os.path.exists(dir):
        os.mkdir(dir)  # build file
        print("build file.")
    if os.path.exists(file_path):
        os.remove(file_path)
        print("Remove existing file")

    # 定義密碼和加密/解密的緩衝區大小
    bufferSize = 64 * 1024  # 64kb 要增加也是以64的倍數增加
    password = "admin@LanguageForest"
    # Write the file content to a buffer
    file_data = bytes(html_content, 'utf-8')

    # Encrypt the buffer and write it to the file
    with io.BytesIO(file_data) as f_in:
        with open(file_path+".aes", 'wb') as f_out:
            pyAesCrypt.encryptStream(f_in, f_out, password, bufferSize)

    # Check if the encrypted file exists
    if os.path.exists(file_path+".aes"):
        print("Encryption successful.")
    else:
        print("Encryption failed.")

def localCryptToWeb(nName, dir):

    file_name=repr(nName).replace("/", "_")+".html"
    file_path = os.path.abspath(os.path.join(dir, file_name))
    
    # os.chdir(sys.path[0])
    if os.path.exists(file_path+".aes"):
        # Encryption parameters
        bufferSize = 64 * 1024  # 64kb 要增加也是以64的倍數增加
        password = "admin@LanguageForest"

        # Read the encrypted file content into a buffer
        try:
            file_data = None
            file_size = os.path.getsize(file_path+".aes")
            with open(file_path+".aes", 'rb') as f_in:
                with io.BytesIO() as f_out:
                    pyAesCrypt.decryptStream(f_in, f_out, password, bufferSize, file_size)
                    file_data = f_out.getvalue()
            print("Decryption successful.")
        except ValueError:
            print("Decryption failed. Incorrect password or Abnormally modified files.")
        except:
            print("Unexpected error:", sys.exc_info())
            

        # Decode the decrypted buffer into a string
        if file_data != None:
            html_content = file_data.decode('utf-8')
            root=bs4.BeautifulSoup(html_content, "html.parser")
            print(root)
            # nName=root.find("p", id="nName")
            # nName=nName.string
            # author=root.find("p", id="author")
            # author=author.string
            # completed=root.find("p", id="completed")
            # description=root.find("p", id="description")
            # description=description.decode_contents()
            # tags=root.find("p", id="tags")
            # tags=tags.decode_contents()
            # articles=root.find("div", "articles")
            # aChapter=""
            # aName=""
            # aContent=""
            # #create a session object
            # session=requests.Session()
            

        else:
            print(f"The file {file_path} is None!")
            return
    else:
        print(f"The file {file_path} does not exist!")
        return
# def crawlerToHtml(pageURL, wb_name, dir):
#     # insert novel
#     #wb_name include: 小說狂人(czbooks)、起點中文網(qidian)、晉江文學城(jjwxc)
#     if (wb_name == "czbooks"):
#         nName, author, description, completed, tags, nImg_link, nextLink = get_czbooks_novel(
#             pageURL)
#     elif (wb_name == "qidian"):
#         nName, author, description, completed, tags, nImg_link, nextLink = get_qidian_novel(
#             pageURL)
#     elif (wb_name == "jjwxc"):
#         nName, author, description, completed, tags, nImg_link, nextLink = get_jjwxc_novel(
#             pageURL)
#     print(nImg_link)
#     html_content="<html><body>"
#     html_content+="<p id='nName'>{}</p><p id='author'>{}</p><p id='nImg_link'>{}</p><p id='completed'>{}</p><p id='description'>{}</p>".format(nName, author, nImg_link, completed, description)
#     html_content+="<p id='tags'>{}</p>".format(",".join(tags))
#     pageURL = nextLink
#     # insert article
#     if(wb_name == "czbooks"):
#         aChapter = 0
#         html_content+="<div id='articles'>"
#         while nextLink != "":
#             aName, aContent, nextLink = get_czbooks_article(pageURL)

#             html_content+="<div id='aChapter-{}'><p id='aName'>{}</p><p id='aContent'>{}</p></div>".format(aChapter, aName, aContent)
#             # 防止TypeError: can only concatenate str (not "NoneType") to str
#             if nextLink is None:
#                 nextLink = ""
#             pageURL = nextLink
#             aChapter += 1
#     elif(wb_name=="qidian"):
#         aChapter = 1
#         while nextLink != "":
#             aName, aContent, nextLink = get_qidian_article(pageURL)

#             html_content+="<div id='aChapter-{}'><p id='articleName'>{}</p><p id='articleContent'>{}</p></div>".format(aChapter, aName, aContent)
#             # 防止TypeError: can only concatenate str (not "NoneType") to str
#             if nextLink is None:
#                 nextLink = ""
#             pageURL = nextLink
#             aChapter += 1
#     elif(wb_name=="jjwxc"): 
#         aChapter = 1
#         while nextLink != "":
#             aName, aContent, nextLink = get_jjwxc_article(pageURL)

#             html_content+="<div id='aChapter-{}'><p id='articleName'>{}</p><p id='articleContent'>{}</p></div>".format(aChapter, aName, aContent)
#             # 防止TypeError: can only concatenate str (not "NoneType") to str
#             if nextLink is None:
#                 nextLink = ""
#             pageURL = nextLink
#             aChapter += 1
    
#     html_content+="</body></html>"
    
#     #Store to local
#     file_name=repr(nName).replace("/", "_")
#     file_name=file_name.strip("'")+".html"
#     file_path = os.path.abspath(os.path.join(dir, file_name))

#     # os.chdir(sys.path[0])
#     if not os.path.exists(dir):
#         os.mkdir(dir)  # build file
#         print("build file.")
#     if os.path.exists(file_path):
#         try:
#             os.remove(file_path)
#             print("Remove existing file")
#         except PermissionError:
#             exit(1)


#     # Encrypt the buffer and write it to the file
#     with open(file_path, 'w', encoding='utf-8') as f:
#         f.write(html_content)

#     # Check if the encrypted file exists
#     if os.path.exists(file_path):
#         print("Download successful.")
#     else:
#         print("Download failed.")
 

# def htmlToWeb(nName, dir):

#     file_name=repr(nName).replace("/", "_")
#     file_name=file_name.strip("'")+".html"
#     file_path = os.path.abspath(os.path.join(dir, file_name))
    
#     if os.path.exists(file_path):
        
#         with open(file_path, 'rb') as f:
#             html_content=f.read()
#         print("Decryption successful.")
        
#         # Decode the decrypted buffer into a string
#         if html_content != None:
#             root=bs4.BeautifulSoup(html_content, "html.parser")
#             print(root)
#             # nName=root.find("p", id="nName")
#             # nName=nName.string
#             # author=root.find("p", id="author")
#             # author=author.string
#             # completed=root.find("p", id="completed")
#             # description=root.find("p", id="description")
#             # description=description.decode_contents()
#             # tags=root.find("p", id="tags")
#             # tags=tags.decode_contents()
#             # articles=root.find("div", "articles")
#             # aChapter=""
#             # aName=""
#             # aContent=""
#             # #create a session object
#             # session=requests.Session()
            

#         else:
#             print(f"The file {file_path} is None!")
#             return
#     else:
#         print(f"The file {file_path} does not exist!")
#         return


pageURL = "https://czbooks.net/n/cpgb0a1"
# crawlerCryptToLocal(pageURL, "czbooks", "C:/xampp/htdocs/Novel_reader/scripts/crawler/") #pageURL, wb_name, dir
localCryptToWeb("毒液/Venom", "C:/xampp/htdocs/Novel_reader/scripts/crawler/") #nName, dir