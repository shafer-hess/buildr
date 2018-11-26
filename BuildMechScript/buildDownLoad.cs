using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.Networking;

public class buildDownLoad : MonoBehaviour {

    const int BUILDDATA = 0;
    const int BUILDNAME = 1;
    const int AUTHORNAME = 2;
    const int USERNAME = 3;
    const int LOCATION = 4;
    const int PRIVACY = 5;
    const int AVATAR = 6;
    const int UPVOTES = 7;
    string[] respData;

    public GameObject theBuild;//the parent gameobject you want to spawn the build on, must have no child
    public GameObject AR_OBJECT;// the AR_object
    public Vector3 spawn_point;

    string url = "http://ec2-18-217-185-132.us-east-2.compute.amazonaws.com/";

    //the texts and buttons should be hidden when there is no building
    public Text authorNameText;
    public Text buildNameText;
    public InputField reportString;
    public Image avatar;
    public Image[] avatars;

    public Button upvoteButton;

    string currUserName;
    string currLocation;

    // Use this for initialization
    void Start()
    {
        theBuild = new GameObject("theBuild");
        theBuild.transform.SetParent(AR_OBJECT.transform);
        theBuild.transform.localPosition = spawn_point;

        currUserName = PlayerPrefs.GetString("username", "");//Login to change the username, default is an empty str
        currLocation = PlayerPrefs.GetString("location", "");//scan pictures to change the location, default is an empty str

        //for testing, use
        currLocation = "sampleloaction2";
    }

    IEnumerator DownLoadBuildingEnum(Transform buildPos)
    {
        string msg = "username=" + currUserName + "&location=" + currLocation;
        using (UnityWebRequest www = UnityWebRequest.Get(url + "getBuild.php?" + msg))
        {
            Debug.Log(url + "getBuild.php?" + msg);
            yield return www.SendWebRequest();

            if (www.isNetworkError || www.isHttpError)
            {
                Debug.Log(www.error);
            }
            else
            {
                string response = www.downloadHandler.text;
                Debug.Log(response);
                respData = response.Split(new[] { "||" }, System.StringSplitOptions.None);

                /*load the build on the gaven transform, the third arguement is the scale of
                 * the build, initial block demision is 5m*5m*5m
                */
                respData[0] = HelperFuns.jsonParse(respData[0], false);
                Debug.Log(respData[0] + "\n'");

                try
                {
                    HelperFuns.LoadShipFromJson(buildPos, respData[0], 0.01f);

                    //code to show author name, buildname and upvotes
                    buildNameText.text = respData[BUILDNAME];
                    authorNameText.text = respData[AUTHORNAME];
                    upvoteButton.GetComponent<Text>().text = respData[UPVOTES];
                    int avatarIndex = 0;
                    int.TryParse(respData[AVATAR], out avatarIndex);
                    avatar = avatars[avatarIndex];
                }
                finally
                {
                    //add code here. When there is no buildings in the database, show a notifucation
                    
                }

            }
        }
    }

    //Add to download button
    public void DownloadBuilding()
    {
        StartCoroutine(DownLoadBuildingEnum(theBuild.transform));
    }

    IEnumerator UpvoteEnum()
    {
        string oldUpvote = upvoteButton.GetComponent<Text>().text;
        int newUpvote = 0;
        int.TryParse(oldUpvote, out newUpvote);
        ++newUpvote;
        upvoteButton.GetComponent<Text>().text = newUpvote.ToString();

        string msg = "username=" + respData[AUTHORNAME] + "&buildname=" + respData[BUILDNAME];
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
            }
        }
    }

    //Add to upvote button
    public void Upvote()
    {
        StartCoroutine(UpvoteEnum());
    }

    IEnumerator ReportEnum()
    {
        string msg = "username=" + respData[AUTHORNAME] + "&report_text=" + reportString.text;
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

            }
        }
    }

    //Add to report button
    public void Report()
    {
        StartCoroutine(ReportEnum());
    }
}
