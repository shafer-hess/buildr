using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.Networking;

public class UpvoteTest : MonoBehaviour {

    const int BUILDDATA = 0;
    const int BUILDNAME = 1;
    const int AUTHORNAME = 2;
    const int LOCATION = 3;
    const int PRIVACY = 4;
    const int AVATAR = 5;
    const int UPVOTES = 6;
    string[] respData;

    public GameObject theBuild;
    string url = "http://ec2-18-217-185-132.us-east-2.compute.amazonaws.com/";
    // Use this for initialization
    void Start () {
		
	}
	
	// Update is called once per frame
	void Update () {
		
	}

    IEnumerator UploadBuildingEnum(string buildData, string buildName, string userName, string location, string privacy, string avatar)
    {
        HelperFuns.WordCenser(ref buildName);
        WWWForm form = new WWWForm();
        form.AddField("buildData", buildData);
        form.AddField("buildName", buildName);
        form.AddField("userName", userName);
        form.AddField("location", location);
        form.AddField("privacy", privacy);
        form.AddField("avatar", avatar);
        //string msg = "buildData=" + "simplestr" + "&buildName=" + buildName + "&userName=" + userName + "&location=" + location + "&privacy=" + privacy + "&avatar=" + avatar;
        Debug.Log(buildData + "\n");

        using (UnityWebRequest www = UnityWebRequest.Post(url + "uploadBuild.php", form))
        {
            //www.chunkedTransfer = false;
            yield return www.SendWebRequest();

            if (www.isNetworkError || www.isHttpError)
            {
                Debug.Log(www.error);
            }
            else
            {
                Debug.Log(www.downloadHandler.text);
            }
        }
    }

    IEnumerator DownLoadBuildingEnum(Transform buildPos)
    {
        string msg = "username=" + "samplename" + "&location=" + "testlocation0";
        using (UnityWebRequest www = UnityWebRequest.Get(url + "getBuild.php?" + msg))
        {
            //www.chunkedTransfer = false;
            Debug.Log(url + "getBuild.php?" + msg);
            yield return www.SendWebRequest();

            if (www.isNetworkError || www.isHttpError)
            {
                Debug.Log(www.error);
                string defData = "{\"shipName\":\"defaultName\",\"cubeDatas\":[{\"cubeName\":\"Cube0\",\"materialName\":\"Material0\",\"transformDatas\":{\"position\":{\"x\":0.0,\"y\":0.0,\"z\":0.0},\"rotation\":{\"x\":0.0,\"y\":0.0,\"z\":0.0,\"w\":1.0},\"scale\":{\"x\":1.0,\"y\":1.0,\"z\":1.0}}},{\"cubeName\":\"WindowRoom\",\"materialName\":\"Material0\",\"transformDatas\":{\"position\":{\"x\":0.0,\"y\":5.0,\"z\":0.0},\"rotation\":{\"x\":0.0,\"y\":0.0,\"z\":0.0,\"w\":1.0},\"scale\":{\"x\":1.0,\"y\":1.0,\"z\":1.0}}},{\"cubeName\":\"WindowRoom\",\"materialName\":\"Material0\",\"transformDatas\":{\"position\":{\"x\":5.0,\"y\":5.0,\"z\":0.0},\"rotation\":{\"x\":0.0,\"y\":0.0,\"z\":0.0,\"w\":1.0},\"scale\":{\"x\":1.0,\"y\":1.0,\"z\":1.0}}}]}";
                HelperFuns.LoadShipFromJson(buildPos, defData, 0.01f);
            }
            else
            {
                string response = www.downloadHandler.text;
                Debug.Log(response);
                respData = response.Split(new[] { "||" }, System.StringSplitOptions.None);
                //write code to show author name here, the author name is respData[USERNAME]
            }
        }
    }

    IEnumerator UpvoteEnum()
    {
        string msg = "username=" + respData[AUTHORNAME] + "&buildName=" + respData[BUILDNAME];
        using (UnityWebRequest www = UnityWebRequest.Get(url + "upvoteBuild.php?" + msg))
        {
            //www.chunkedTransfer = false;
            Debug.Log(url + "upvoteBuild.php?" + msg);
            yield return www.SendWebRequest();

            if (www.isNetworkError || www.isHttpError)
            {
                Debug.Log(www.error);
            }
            else
            {
                string response = www.downloadHandler.text;
                Debug.Log(response);

                //write code to show author name here, the author name is respData[USERNAME]
            }
        }
    }

    IEnumerator ReportEnum()
    {
        string msg = "username=" + "samplename" + "&report_text=" + "sampletext";
        using (UnityWebRequest www = UnityWebRequest.Get(url + "addReport.php?" + msg))
        {
            //www.chunkedTransfer = false;
            Debug.Log(url + "addReport.php?" + msg);
            yield return www.SendWebRequest();

            if (www.isNetworkError || www.isHttpError)
            {
                Debug.Log(www.error);
            }
            else
            {
                string response = www.downloadHandler.text;
                Debug.Log(response);

                //write code to show author name here, the author name is respData[USERNAME]
            }
        }
    }

    IEnumerator TestUpvoteEnum()
    {
        string defData = "{\"shipName\":\"defaultName\",\"cubeDatas\":[{\"cubeName\":\"Cube0\",\"materialName\":\"Material0\",\"transformDatas\":{\"position\":{\"x\":0.0,\"y\":0.0,\"z\":0.0},\"rotation\":{\"x\":0.0,\"y\":0.0,\"z\":0.0,\"w\":1.0},\"scale\":{\"x\":1.0,\"y\":1.0,\"z\":1.0}}},{\"cubeName\":\"WindowRoom\",\"materialName\":\"Material0\",\"transformDatas\":{\"position\":{\"x\":0.0,\"y\":5.0,\"z\":0.0},\"rotation\":{\"x\":0.0,\"y\":0.0,\"z\":0.0,\"w\":1.0},\"scale\":{\"x\":1.0,\"y\":1.0,\"z\":1.0}}},{\"cubeName\":\"WindowRoom\",\"materialName\":\"Material0\",\"transformDatas\":{\"position\":{\"x\":5.0,\"y\":5.0,\"z\":0.0},\"rotation\":{\"x\":0.0,\"y\":0.0,\"z\":0.0,\"w\":1.0},\"scale\":{\"x\":1.0,\"y\":1.0,\"z\":1.0}}}]}";
        defData = HelperFuns.jsonParse(defData, true);
        //yield return StartCoroutine(UploadBuildingEnum(defData, "upvoteTest", "samplename", "testlocation0", "0", "0"));
        yield return StartCoroutine(DownLoadBuildingEnum(theBuild.transform));
        int initUpvote;
        if(int.TryParse(respData[UPVOTES], out initUpvote))
        {
            Debug.Log("initupvote: "+ initUpvote);
        }
        else
        {
            Debug.Log("upvote test failed: downloading request error");
        }

        yield return StartCoroutine(UpvoteEnum());
        Debug.Log("downloading upvoted building");
        yield return StartCoroutine(DownLoadBuildingEnum(theBuild.transform));
        
        int upvote;
        if (int.TryParse(respData[UPVOTES], out upvote))
        {
            Debug.Log("upvotes after upvote: " + upvote);
            if (upvote - initUpvote == 1)
            {
                Debug.Log("upvotetest pass");
            }
            else
            {
                Debug.Log("upvote test failed: upvotes not updating");
            }
        }
        else
        {
            Debug.Log("upvote test failed: downloading request error");
        }
    }

    public void TestUpvote()
    {
        StartCoroutine(TestUpvoteEnum());
    }
}
